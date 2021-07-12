<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('../connection.php');
    $id = $_SESSION['User'];
    $id1 =$_SESSION['UserID'];
    //$query2 = "SELECT * FROM subject_user as s,choose_a_teaching as c,classroom_user as class, prepare_hours as pre WHERE c.master_id= ".$id." AND c.subject_id = s.subject_id AND c.class_id = class.class_id AND pre.subject_id = s.subject_id";//เชื่อม2ตาราง
    //$result2 = mysqli_query($conn,$query2); 

    if(isset($_REQUEST['update_id'])){
        
            $id2 = $_REQUEST['update_id'];
            $sql = "SELECT * FROM prepare_to_teach as pre ,choose_a_teaching as c, subject as sub , classroom as class, grade_level as grade
            WHERE pre.id_prepare = '".$id2."' AND c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.grade_id = grade.grade_id AND
            pre.choose_id = c.choose_id ";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
            $row = mysqli_fetch_array($result);
            extract($row);
        
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up 
        
        $learn_up =$_REQUEST['txt_learn'];
        $purpose_up =$_REQUEST['txt_pur'];
        $how_to_teach_up =$_REQUEST['txt_how'];
        $media_up =$_REQUEST['txt_media']; 
        $measure_up =$_REQUEST['txt_measure'];
       // echo 'update ='.$id = $_REQUEST['update_id'] .'<br>';
        $date_prepare = $_REQUEST['txt_date'];
        $status = "Checking";
        
        $choose_id = $_REQUEST['txt_choose_id'];
        
        
        

        if(empty($learn_up)){
                $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของสาระการเรียนรู้/ตัวชี้วัด";
        }else if(empty($purpose_up)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของจุดประสงค์";
        }else if(empty($how_to_teach_up)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของสอนอย่างไร(กระบวนการจัดการเรียน)";
        }else if(empty($media_up)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของสื่อ/อุปกรณ์การเรียนรู้";
        }else if(empty($measure_up)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของวิธีวัดและประเมินการสอน/เครื่องมือ";
        }else{
            
                if(!isset($errorMsg))
                    $sql = "UPDATE prepare_to_teach SET  choose_id = '".$choose_id."', date_prepare ='".$date_prepare."'
                   , learning='".$learn_up."',purpose='".$purpose_up."',how_to_teach='".$how_to_teach_up."',media='".$media_up."',measure='".$measure_up."',status_prepare_hours='".$status."' 
                   WHERE id_prepare = '".$id2."' ";
                $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                mysqli_close($conn); //ปิดการเชื่อมต่อ database 

                if($result){
                    echo "<script type='text/javascript'>";
                    
                    echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
                    echo "window.location = 'hours.php'; ";
                    echo "</script>";
                    }
                    else{
                    echo "<script type='text/javascript'>";
                    echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
                    echo "</script>";
                            
                        }
            
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเตรียมสอนรายชั่วโมง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script> <!-- datepickerเก่า -->
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> <!-- datepickerเก่า -->
    <link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.datetimepicker.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script language="JavaScript">
    $(function() {
        var dates = $("#datepicker").datepicker({
            dateFormat: 'dd/mm/yy',          
            defaultDate: "+1w",
            changeMonth: true,
            minDate: 0,
            beforeShowDay: noWeekends

           
        });

        function noWeekends(date) {
            var day = date.getDay();
            // ถ้าวันเป็นวันอาทิตย์ (0) หรือวันเสาร์ (6)
            if (day === 0 || day === 6) {
                // เลือกไม่ได้
                return [false, "", "วันนี้เป็นวันหยุด"];
            }
            // เลือกได้ตามปกติ
            return [true, "", ""];
        }
        $("#datepicker").datepicker({
            beforeShowDay: noWeekends
        });
    });
    </script>
    </script>
</head>
<body>
<?php include_once('slidebar_teacher.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">หน้าแก้ไขข้อมูลเตรียมการสอน</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
        if(isset($updateMeg)){
    ?>
        <div class="alert alert-success">
        <strong>success <?php echo $updateMeg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_up" class="form-control" value="<?php echo $_SESSION['User'];?>"readonly/>
                </div>
                </div>
            </div>

            <?php
                        $query2 = "SELECT * FROM choose_a_teaching as c, subject as sub, classroom as class
                        WHERE c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.master_id = '".$id1."' " ;//เชื่อม2ตาราง
                        $result2 = mysqli_query($conn, $query2);
                    ?>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน</label>
                    <div class="col-sm-6">
                        <select name="txt_choose_id" class="form-control">
                            <option value="<?php  echo $choose_id; ?>"><?php echo $name_subject.' '.$name_classroom.'  '.$choose_id; ?></option>
                            <?php foreach($result2 as $row2){
                                if($row2['status_choose'] == 'Active' && $row2["choose_id"] !==$choose_id ){?>
                            <option value="<?php echo $row2["choose_id"]; ?>">
                                <?php echo $row2['code_subject'].' '.$row2['name_subject'].' ('.$row2['name_classroom'].')';?>
                                
                            </option>

                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            
            
            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">วันที่</label>
                <div class="col-sm-6">
                <input type="text" name="txt_date" class="form-control" id="datepicker" value="<?php echo $row['date_prepare'];?>"placeholder="วัน/เดือน/ปี">
                
                
                </div>
                </div>
            </div>


            

            <div class="form- text-center">
                <div class="row">
                <label for="name_learn" class="col-sm-3 control-label">สาระการเรียนรู้/ตัวชี้วัด</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="txt_learn" class="form-control" required><?php echo $row['learning']; ?></textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_pur" class="col-sm-3 control-label">จุดประสงค์</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="txt_pur" class="form-control" required><?php echo $purpose; ?></textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_how" class="col-sm-3 control-label">สอนอย่างไร</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="txt_how" class="form-control" required><?php echo $how_to_teach; ?></textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">สื่อ/อุปกรณ์การเรียนรู้</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="txt_media" class="form-control"required><?php echo $media; ?></textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="txt_measurea" class="col-sm-3 control-label">วิธีวัดและประเมินการสอน/เครื่องมือ</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="txt_measure" class="form-control"required><?php echo $measure; ?></textarea>
                </div>
                </div>
            </div>

            

            <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="ยืนยัน">
                    <a href="hours.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>

    </form>
</div>
    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>