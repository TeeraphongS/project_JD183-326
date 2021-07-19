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
            


    if(isset($_REQUEST['download_id'])){
        
            $id = $_REQUEST['download_id'];
            $sql = "SELECT * FROM weekly_summary as week,choose_a_teaching as c,subject as sub, classroom  as class,login_information as login
            WHERE week.choose_id = c.choose_id AND c.subject_id = sub.subject_id AND c.master_id = login.master_id AND c.class_id =class.class_id AND week.id_prepare_week = $id ";
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
    <link rel="stylesheet" href="download_week.css">

</head>
<body">

    <div class="container">
    <form method="post" class="form-horizontal mt-5">
    <div class="display-3 text-center">บันทึกรายงานผลการปฎิบัติงานในรอบสัปดาห์</div>

    <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชื่อ-นามสกุล </label>
                    <div class="col-sm-6"><?php echo  $fname.' '.$lname; ?> </div>
                </div>
            </div>
    
            <?php 
            $id = $_REQUEST['download_id'];
            $query = "SELECT * FROM weekly_summary as week,choose_a_teaching as c,subject as sub, classroom  as class
            WHERE week.choose_id = c.choose_id AND c.subject_id = sub.subject_id AND c.class_id =class.class_id AND week.id_prepare_week = '".$id."' ";
            $result1 = mysqli_query($conn,$query);
            ?>

             <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วันที่รายงานผล</label>
                    <div class="col-sm-6">
                    <?php echo $row['date_prepare_week']; ?>
                    </div>
                </div>
            </div>


            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วิชา</label>
                    <div class="col-sm-6">
                    <?php foreach($result1 as $row1){?>
                         
                        <?php  echo $row1['name_subject']; ?>
                    <?php }?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชั้น</label>
                    <div class="col-sm-6">
                    <?php foreach($result1 as $row1){?>
                   
                   
                        <?php echo $row1['name_classroom']; ?>
                        
                        
                    <?php }?>
                    </div>
                </div>
            </div>

            

            <div class="form- text">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">เป้าหมาย</label>
                    <div class="col-sm-6">
                        <?php echo $row['goal']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ผลการปฎิบัติงาน</label>
                    <div class="col-sm-6">
                        <?php echo $row['result']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">กิจกรรมที่ทำได้ดี</label>
                    <div class="col-sm-6">
                        <?php echo $row['activity_good']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">กิจกรรมที่ทำได้ไม่ดี</label>
                    <div class="col-sm-6">
                    <?php echo $row['activity_nogood']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ปัญหา/อุปสรรค</label>
                    <div class="col-sm-6">
                    <?php echo $row['problem']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">นักเรียน/กิจกรรมที่ต้องปรับปรุง</label>
                    <div class="col-sm-6">
                    <?php echo $row['student']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">แนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป</label>
                    <div class="col-sm-6">
                    <?php echo $row['Solve_the_problem']; ?>
                    </div>
                </div>
            </div>






       

            <?php 
             //เป็นการกำหนด Font LilyUPC ตัวปกติ ขนาด 16
                $html = ob_get_contents();
                $mpdf->WriteHTML($html);
                $mpdf->Output("MyReport_week.pdf");
                
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
    <script>document.location.href='MyReport_week.pdf';</script>
    
</body>
</html>

