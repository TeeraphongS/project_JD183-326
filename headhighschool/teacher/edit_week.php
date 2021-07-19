<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('../connection.php');

    $id1 =$_SESSION['UserID'];


    if(isset($_REQUEST['update_id'])){

            $id = $_REQUEST['update_id'];
            $sql = "SELECT * FROM weekly_summary as week ,choose_a_teaching as c, subject as sub , classroom as class, grade_level as grade
            WHERE week.id_prepare_week = '".$id."' AND c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.grade_id = grade.grade_id AND
            week.choose_id = c.choose_id ";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
            $row = mysqli_fetch_array($result);
            extract($row);
        
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        //$fname_lname ;
        $date = $_REQUEST['txt_date'] ;
        $goal = $_REQUEST['txt_goal'];
        $result = $_REQUEST['txt_result'];
        $activity_good = $_REQUEST['txt_activity_good'];
        $activity_nogood = $_REQUEST['txt_activity_nogood'];
        $problem = $_REQUEST['txt_problem'];
        $student = $_REQUEST['txt_student'];
        $solve_the_problem = $_REQUEST['txt_solve_the_problem'];
        //$subject = $_REQUEST['txt_subject'];
        $choose_id = $_REQUEST['txt_choose_id'];


        if(empty($goal)){
            $errorMsg = "กรุณากรอกเป้าหมาย";
        }elseif(empty($result)){
            $errorMsg = "กรุณากรอกผลการปฎิบัติงาน";
        }else if(empty($activity_good)){
                $errorMsg = "กรุณากรอกกิจกรรมที่ทำได้ดี";
        }else if(empty($activity_nogood)){
            $errorMsg = "กรุณากรอกกิจกรรมที่ทำได้ไม่ดี";
        }else if(empty($problem)){
            $errorMsg = "กรุณากรอกปัญหา/อุปสรรค";
        }else if(empty($student)){
            $errorMsg = "กรุณากรอก นักเรียน/กิจกรรมที่ควรปรับปรุง";
        }else if(empty($solve_the_problem)){
            $errorMsg = "กรุณากรอกแนวทางการแก้ไขปัญหาหรือการปฎิบัติครั้งต่อไป";
        }else {
            
                if(!isset($errorMsg))
                $sql = "UPDATE weekly_summary 
                SET choose_id = '".$choose_id."', date_prepare_week = '".$date."', goal = '".$goal."', result = '".$result."', activity_good = '".$activity_good."', activity_nogood = '".$activity_nogood."', problem ='".$problem."', student = '".$student."', Solve_the_problem ='".$solve_the_problem."'  
                , status_prepare_week ='Checking' WHERE id_prepare_week = '".$id."' ";
                $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                mysqli_close($conn); //ปิดการเชื่อมต่อ database 

                if($result){
                    echo "<script type='text/javascript'>";
                    echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
                    echo "window.location = 'week.php'; ";
                    echo "</script>";
                    }
                    else{
                    echo "<script type='text/javascript'>";
                    echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
                    echo "</script>";
                            
                        }
        }

    }//ขนมปัง

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสรุปผลรายสัปดาห์</title>
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
            <div class="display-3 text-center">หน้าแก้ไขสรุปผลรายสัปดาห์</div>
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
                    <label for="fname" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_firstname" class="form-control"
                            value="<?php echo $_SESSION['User']; ?>" readonly>
                    </div>
                </div>
            </div>
            <br>
            
            >

            <div class="form- text-center">
                <div class="row">
                    <label for="name_classroom" class="col-sm-3 control-label">วันที่รายงานผล</label>
                    <div class="col-sm-6">
                    <input type="text" name="txt_date" class="form-control" id="datepicker" value="<?php echo $row['date_prepare_week'];?>"placeholder="วัน/เดือน/ปี">
                    </div>
                </div>
            </div>
            <br>

            <?php
                        $query2 = "SELECT * FROM choose_a_teaching as c, subject as sub, classroom as class
                        WHERE c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.master_id = '".$id1."' " ;//เชื่อม2ตาราง
                        $result2 = mysqli_query($conn, $query2);
                    ?>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน/กิจกรรมที่ทำ</label>
                    <div class="col-sm-6">
                        <select name="txt_choose_id" class="form-control">
                            <option value="<?php  echo $choose_id; ?>"><?php echo $name_subject.' ('.$name_classroom.')'; ?></option>
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
            <br>
            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">เป้าหมาย</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_goal" rows="4" cols="95" value=""><?php echo $row['goal'];?></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ผลการปฎิบัติงาน</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_result" rows="4" cols="95" ><?php echo $row['result'];?></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ดี</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_activity_good" rows="4" cols="95"><?php echo $row['activity_good'];?></textarea>
                    </div>
                </div>
            </div>

            <br>
            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ไม่ดี</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_activity_nogood" rows="4" cols="95"><?php echo $row['activity_nogood'];?></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ปัญหา/อุปสรรค</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_problem" rows="4" cols="95" ><?php echo $row['problem'];?></textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">นักเรียน/กิจกรรมที่ต้องปรับปรุง</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_student" rows="4" cols="95" ><?php echo $row['student'];?></textarea>
                    </div>
                </div>
            </div>


            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">แนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_solve_the_problem" rows="4" cols="95"><?php echo $row['Solve_the_problem'];?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="week.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>

        </form>
    </div>





    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>