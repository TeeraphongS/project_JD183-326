<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    require_once __DIR__ . '../../vendor/autoload.php';
    

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/tmp',
        ]),
        'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' => 'THSarabunNew Bold.ttf',
                'BI' => 'THSarabunNew BoldItalic.ttf'
            ]
        ],
        'default_font' => 'sarabun'
    
    ]);
    

    

    require_once('../connection.php');
            
    $id1 = $_SESSION['UserID'];
    if(isset($_REQUEST['download_id'])){
        
            $id = $_REQUEST['download_id'];
            $sql = "SELECT * FROM choose_a_teaching as c,subject as sub, classroom  as class,login_information as login, grade_level as grade,time ,year as y
            WHERE  c.choose_id = $id AND c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.year_id = y.year_id AND c.master_id =login.master_id AND c.master_id = $id1 
            AND c.grade_id = grade.grade_id AND c.time_id = time.time_id";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
            $row = mysqli_fetch_array($result);
            extract($row);
        
    }
    ob_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title>หน้าดาวน์โหลดเตรียมสอนรายชั่วโมง</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="teaching.css">

</head>

<body>
    <div class="container">
        <?php 
    $data_schedule=array();//array ของข้อมูล
    $sql ="SELECT * FROM choose_a_teaching as c,login_information as login, classroom as class, subject as sub, grade_level as grade, time ,year as y
    WHERE c.master_id = login.master_id AND c.class_id = class.class_id AND c.year_id = y.year_id AND c.subject_id = sub.subject_id AND c.grade_id = grade.grade_id AND c.time_id = time.time_id ";
    $query=mysqli_query($conn,$sql);
?>
        <form method="post" class="form-horizontal mt-5">
            <div class="display-5 text-center">โรงเรียนกัลยาณชนรังสรรค์มูลนิธิ มัสยิดบ้านเหนือ</div>
            <div class="display-7 text-center">รายงานตารางสอนของครูผู้สอน ภาคเรียน :
                <?php if($id1 == $row["master_id"]){ echo $row["term"].'/'.$row["year_name"];} ?></div>
            <div class="display-7 text-left">ครูผู้สอน : <?php if($id1 == $row["master_id"]){
        echo $row["fname"].' '.$row["lname"];
     } ?></div>
            <br>


            <table align="center">

                <?php
            $sql1="SELECT * FROM time";
            $query1=mysqli_query($conn,$sql1);

            $sql4="SELECT COUNT(time_id) FROM time WHERE status_time = 'Active' ";
            $query4=mysqli_query($conn,$sql4);
            $row4 = mysqli_fetch_array($query4);
            $kab = $row4["COUNT(time_id)"] ;
            
            

            
            //$result1 = mysqli_fetch_array($query1);
            //$result1z = $result1["time_id"]; 
         ?>
                <tr>
                    <th rowspan="2" align="center" valign="middle" height="50">วัน/เวลา</th>
                    <?php 
                    for ($i = 1; $i <= $kab; $i++) { ?>

                    <th align="center" valign="middle" height="50"><?php echo "คาบที่ $i"; ?></th>
                    <?php } ?>
                </tr>
                <tr>
                    <?php while($row1 =  mysqli_fetch_array($query1)){ ?>
                    <th align="center" valign="middle" height="50"><?php echo $row1["time_name"]; ?></th>
                    <?php } ?>
                </tr>
                <?php /*
        $dayInSchedule_chk=$row["time_id"];//วันแรกของอาทิตย์เช็คค่า
        $dayInSchedule_show=$row["time_id"];//วันแรกของอาทิตย์โชว์ค่า
    if(isset($data_schedule[$dayInSchedule_chk])){//ตรวจสอบ array ของข้อมูล[วันแรกของอาทิตย์เช็คค่า]ว่ามีข้อมูลไหม
        $num_data=count($data_schedule[$dayInSchedule_chk]);//นับจำนวนของค่า array
    }else{
        $num_data=0;//นับจำนวนของค่า array = 0
    }
    $arr_checkSpan=array();//สร้าง array
    $arr_detailShow=array();//สร้าง array*/
   // $real_sc_numCol=7;//ค่าคาบจริง
    /*for($i_time=1;$i_time<8/* คาบ*//*;$i_time++){    //เวลา
        if($num_data>0){//หากมีข้อมูลในฐานมากกว่า0
        $haveIN=0;//ตัวแปร
        $dataShow="";//ชื่อวิชา
        foreach($data_schedule[$dayInSchedule_chk] as $k=>$v){//ตรวจสอบ array ของข้อมูล[วันแรกของอาทิตย์เช็คค่า]ว่ามีข้อมูลไหม
            if(strtotime($dayInSchedule_chk." ".$sc_timeStep[$i_time].":00") == 
            strtotime($dayInSchedule_chk." ".$v['start_time'])){ //เวลาเรื่ม
                $haveIN++; //เพิ่มตัวแปรข้อมูล
                $dataShow=$v['detail'];//โชว์ชื่อวิชา
                $add=1;
                while(strtotime($dayInSchedule_chk." ".$sc_timeStep[$i_time+$add].":00") < 
                strtotime($dayInSchedule_chk." ".$v['end_time'])){//เวลาจบ
                    $haveIN++; //เพิ่มตัวแปรข้อมูล
                    $dataShow=$v['detail']; //โชว์ชื่อวิชา     
                    $add++;
                }
            }
        }
        $arr_checkSpan[$i_time]=$haveIN;//array ตัวแปร เวลา
        $arr_detailShow[$i_time]=$dataShow;// array ชื่อและเวลา
    }  
}*/
            $num_dayShow = 5;// 5 วัน
            //$arr_checkSpan=array();
            //$arr_detailShow=array();
            $thai_day_arr=array("จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์");
    
            
            for($i_day=0;$i_day<$num_dayShow;$i_day++){//วัน
            ?>
                <tr>
                    <td align="center" valign="middle" height="50"><?php echo $thai_day_arr[$i_day];  ?></td><!--วัน-->
                    <?php
                    for($i_time=1;$i_time<= $kab/*7คาบ*/ ;$i_time++){ //ตารางที่ของเวลาที่ว่างๆ **สำคัญ
                        //echo $thai_day_arr[$i_day];
                        $sql3="SELECT * FROM choose_a_teaching as c,grade_level as grade, classroom as class, subject as sub, time as t, year as y,login_information as login
                        WHERE c.master_id = login.master_id AND c.grade_id = grade.grade_id AND c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.time_id = t.time_id AND c.year_id = y.year_id 
                        AND login.master_id ='50' AND date ='$thai_day_arr[$i_day]' AND t.time_id = '$i_time' ";
                        $query3=mysqli_query($conn,$sql3);
                        $row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC);
                
                
                
                
               /* $colspan="";
                $css_use="";
                $dataShowIN="";
                if(isset($arr_checkSpan[$i_time])){
                    
                    *if($arr_checkSpan[$i_time]>0){
                        $dataShowIN=$arr_detailShow[$i_time]; 
                    }
                    if($arr_checkSpan[$i_time]>1){
                        $colspan="colspan=\"".$arr_checkSpan[$i_time]."\"";
                        $step_add=$arr_checkSpan[$i_time]-1;
                        $i_time+=$step_add;
                    }       
                }*/ $date1 = $row3["date"];
                    $time = $row3["time_id"];
                    //echo $thai_day_arr[$i_day];
                    //echo var_dump($row3);
                        if( $thai_day_arr[$i_day][$i_time] == $date1[$time]){?>
                    <td align="center" valign="middle" height="50"><?php echo $row3["code_subject"];?><br><?php echo $row3["name_classroom"]; ?></td>
                    <?php }else{?>
                        <td></td>
                   <?php } ?>





                    <?php  }?>
                
                </tr>
                <?php } ?>

            </table>
            <br>

            <!-- ส่วนลงชื่อ ผอ. -->
            <?php
                $sql2 = "SELECT * FROM login_information as login , user_role as role WHERE login.user_role_id = role.user_role_id AND login.user_role_id = '2' ";
                $query2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_array($query2);

            ?>
            <div class="form- text-leftr">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ลงชื่อ
                        <?php if($row2["user_role_id"] == '2'){ echo $row2["fname"].' '.$row2["lname"];} ?></label>

                </div>
                <div class="row">
                    <label for="" class="col-sm-4 control-label">(
                        <?php if($row2["user_role_id"] == '2'){ echo $row2["fname"].' '.$row2["lname"];} ?> ) </label>
                </div>
            </div>
    </div>




    <?php 
             //เป็นการกำหนด Font LilyUPC ตัวปกติ ขนาด 16
                $html = ob_get_contents();
                $mpdf->WriteHTML($html);
                $mpdf->Output("timetable.pdf");
                
                ob_end_flush();
                

            ?>




    </form>
    <!--<form method="post" class="form-horizontal mt-5">
    
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                <a href="hours.php" class="btn btn-danger">Cancel</a>
                <a href="MyReport_hours.pdf" class="btn btn-info">Download</a>
            </div>
        </div>
    </form>-->



    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
    //document.location.href='timetable.pdf';
    </script>

</body>

</html>