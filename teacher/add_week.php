<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    date_default_timezone_set('Asia/Bangkok');
    require_once('connection.php');

    $id = $_SESSION['master_id'];

    $query2 = "SELECT * FROM subject_user as s,choose_a_teaching as c,classroom_user as class 
    WHERE c.master_id= ".$id." AND c.subject_id = s.subject_id AND c.class_id = class.class_id";//เชื่อม2ตาราง
    $result2 = mysqli_query($conn,$query2);

    if(isset($_REQUEST['btn_insert'])){
        $fname_lname =$_REQUEST['txt_fname_lname'] ;
        $subject = $_REQUEST['txt_subject_id'];
        $date = $_REQUEST['txt_date_prepare_week'];
        $goal = $_REQUEST['txt_goal'];
        $result = $_REQUEST['txt_result'];
        $activity_good = $_REQUEST['txt_activity_good'];
        $activity_nogood = $_REQUEST['txt_activity_nogood'];
        $problem = $_REQUEST['txt_problem'];
        $student = $_REQUEST['txt_student'];
        $solve_the_problem = $_REQUEST['txt_solve_the_problem'];
        

        if(empty($goal)){
            $errorMsg = "Please enter Goal";
        }elseif(empty($result)){
            $errorMsg = "Please enter Result";
        }else if(empty($activity_good)){
                $errorMsg = "Please enter Activity Good";
        }else if(empty($activity_nogood)){
            $errorMsg = "Please enter Activity No Good";
        }else if(empty($problem)){
            $errorMsg = "Please enter Problem";
        }else if(empty($student)){
            $errorMsg = "Please enter Student";
        }else if(empty($solve_the_problem)){
            $errorMsg = "Please enter Solve the problem";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO prepare_week(fname_lname,date_prepare_week,subject_id,goal,result,activity_good,activity_nogood,problem,student,solve_the_problem)
                     VALUE('".$fname_lname."', '".$subject."', '".$date."', '".$goal."', '".$result."', '".$activity_good."', '".$activity_nogood."', '".$problem."', '".$student."', '".$solve_the_problem."')");

                    if($insert_stmt->execute()){
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2,week.php");
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
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
</head>
<body>
<div class="w3-sidebar w3-black w3-bar-block" style="width:20%">
  <a href="teacher_home.php"><h3 class="w3-bar-item">Home</h3></a>
  <a href="hours.php" class="w3-bar-item w3-button">กรอกเตรียมสอนรายชั่วโมง</a>
  <a href="week.php" class="w3-bar-item w3-button">กรอกจุดประสงค์รายสัปดาห์</a>
  <a href="../logout.php" class="w3-bar-item w3-button">Logout</a>
</div>
<div style="margin-left:20%">

<div class="w3-container w3-teal">
</div>
    <div class="w3-container">
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
                    <input type="text" name="txt_fname_lname" class="form-control" value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>"/readonly>
                </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                <label for="name_classroom" class="col-sm-3 control-label">วันที่รายงานผล</label>
                <div class="col-sm-6">
                    <input type="date" name="txt_date_prepare_week" class="form-control" placeholder="วันที่รายงานผล ...">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน</label>
                <div class="col-sm-6">
                    <select name="txt_subject_id" class="form-control">
                    <option value="" selected="selected">- กรุณาเลือก -</option>
                    <?php foreach($result2 as $row2){?>
                
                    <option value="<?php echo $row2["subject_id"] ?>">
                    <?php
                            echo $row2['name_subject'];
                        ?>
                    </option>
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
                <textarea id="" name="txt_goal" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">ผลการปฎิบัติงาน</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_result" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ดี</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_activity_good" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            
            <br>
            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ไม่ดี</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_activity_nogood" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">ปัญหา/อุปสรรค</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_problem" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">นักเรียน/กิจกรรมที่ต้องปรับปรุง</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_student" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>


            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">แนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_solve_the_problem" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>

           

        


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="week.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>