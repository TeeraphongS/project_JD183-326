<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    date_default_timezone_set('Asia/Bangkok');
    require_once('../connection.php');

    $id = $_SESSION['UserID'];

    if(isset($_REQUEST['btn_insert'])){
        //$fname_lname =$_REQUEST['txt_fname_lname'] ;
        //$subject = $_REQUEST['txt_subject_id'];
        $date = $_REQUEST['txt_date'];
        $goal = $_REQUEST['txt_goal'];
        $result = $_REQUEST['txt_result'];
        $activity_good = $_REQUEST['txt_activity_good'];
        $activity_nogood = $_REQUEST['txt_activity_nogood'];
        $problem = $_REQUEST['txt_problem'];
        $student = $_REQUEST['txt_student'];
        $solve_the_problem = $_REQUEST['txt_solve_the_problem'];
        $today = date('m/d/Y');
        //$grade = $_REQUEST['txt_grade'];
        $choose_id = $_REQUEST['txt_choose_id'];
        

        if(empty($goal)){
            $errorMsg = "กรุณากรอกข้อมูลเป้าหมาย";
        }elseif(empty($result)){
            $errorMsg = "กรุณากรอกข้อมูลผลการปฎิบัติงาน";
        }else if(empty($activity_good)){
                $errorMsg = "กรุณากรอกข้อมูลกิจกรรมที่ทำได้ดี";
        }else if(empty($activity_nogood)){
            $errorMsg = "กรุณากรอกข้อมูลกิจกรรมที่ทำได้ไม่ดี";
        }else if(empty($problem)){
            $errorMsg = "กรุณากรอกข้อมูลปัญหา/อุปสรรค";
        }else if(empty($student)){
            $errorMsg = "กรุณากรอกข้อมูลนักเรียน/กิจกรรมที่ต้องปรับปรุง";
        }else if(empty($solve_the_problem)){
            $errorMsg = "กรุณากรอกข้อมูลแนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป";
        }else {
            
                if(!isset($errorMsg)){
                    $sql = "INSERT INTO weekly_summary(choose_id,date_prepare_week,goal,result,activity_good,activity_nogood,problem,student,solve_the_problem)
                     VALUE('$choose_id', '$date', '$goal', '$result', '$activity_good', '$activity_nogood', '$problem', '$student', '$solve_the_problem') ";
                     $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                     //$query = mysqli_query($conn,$sql) or die(mysqli_error($conn) . "<br>$sql");   ตรวจสอบบัค
                     mysqli_close($conn);

                        if($result){
                            echo "<script>";
                            echo "alert('สำเร็จ');";
                            echo "window.location ='week.php'; ";
                            $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                            echo "</script>";
                            } else {
                            
                            echo "<script>";
                            echo "alert('ล้มเหลว!');";
                            echo "window.location ='week.php'; ";
                            echo "</script>";
                            }
                }
            
        }

    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสรุปรายสัปดาห์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
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
            <div class="display-3 text-center">สรุปรายสัปดาห์</div>
        </div>
        <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
        <?php } ?>


        <?php
        if(isset($insertMsg)){
    ?>
        <div class="alert alert-success">
            <strong>success <?php echo $insertMsg; ?></strong>
        </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">

            <div class="form- text-center">
                <div class="row">
                    <label for="fname" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_fname_lname" class="form-control"
                            value="<?php echo $_SESSION['User']; ?>" /readonly>
                    </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                    <label for="name_classroom" class="col-sm-3 control-label">วันที่รายงานผล</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_date" id="datepicker" class="form-control"
                            placeholder="วัน/เดือน/ปี">
                    </div>
                </div>
            </div>
            <br>
            <?php
                        $query2 = "SELECT * FROM choose_a_teaching as c, subject as sub, classroom as class
                        WHERE c.subject_id = sub.subject_id AND c.class_id = class.class_id AND c.master_id = '".$id."' " ;//เชื่อม2ตาราง
                        $result2 = mysqli_query($conn, $query2);
                    ?>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน</label>
                    <div class="col-sm-6">
                        <select name="txt_choose_id" class="form-control">

                            <option value="">- กรุณาเลือก -</option>
                            <?php foreach($result2 as $row2){
                                if($row2['status_choose'] == 'Active'){?>
                            <option value="<?php echo $row2["choose_id"] ?>">
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
                        <textarea id="" name="txt_goal" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ผลการปฎิบัติงาน</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_result" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ดี</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_activity_good" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>

            <br>
            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ไม่ดี</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_activity_nogood" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">ปัญหา/อุปสรรค</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_problem" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">นักเรียน/กิจกรรมที่ต้องปรับปรุง</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_student" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                    <label for="" class="col-sm-3 control-label">แนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป</label>
                    <div class="col-sm-6">
                        <textarea id="" name="txt_solve_the_problem" rows="4" cols="95"></textarea>
                    </div>
                </div>
            </div>
            <br>






            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="เพิ่ม">
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