<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('connection.php');

    $id = $_SESSION['master_id'];
    $query2 = "SELECT * FROM choose_a_teaching as c WHERE c.master_id= ".$id;
    //$query3 = "SELECT * FROM subject_user" ;

    $result2 = mysqli_query($conn,$query2); 
    //$result3 = mysqli_query($conn,$query3);

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_week WHERE id_prepare_week = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        $fname_lname ;
        $date ;
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
                if(!isset($errorMsg))
                $update_stmt = $db->prepare("UPDATE INTO prepare_week(fname_lname,date_prepare_week,subject_id,goal,result,activity_good,activity_nogood,problem,student,solve_the_problem) VALUE(:fname_lname,:date,:subject,:goal,:result,:activity_good,:activity_nogood,:problem,:student,:solve_the_problem)");
                $update_stmt->bindParam(":name_lname", $fname_lname);
                $update_stmt->bindParam(":date", $date);
                $update_stmt->bindParam(":subject", $subject);
                $update_stmt->bindParam(":goal",$goal);
                $update_stmt->bindParam(":result",$result);
                $update_stmt->bindParam(":activity_good", $activity_good);
                $update_stmt->bindParam(":activity_nogood",$activity_nogood);
                $update_stmt->bindParam(":problem", $problem);
                $update_stmt->bindParam(":student", $student);
                $update_stmt->bindParam(":solve_the_problem",$solve_the_problem);

                    if($update_stmt->execute()){
                        $updateMeg = "Record update successfully...";
                        header("refresh:2,week.php");
                    }
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }

    }//ขนมปัง

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Week</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    <div class="container">
    <div class="display-3 text-center">Edit Page</div>
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
                    <input type="text" name="txt_firstname" class="form-control" value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>">
                </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                <label for="name_classroom" class="col-sm-3 control-label">วันที่รายงานผล</label>
                <div class="col-sm-6">
                    <input type="date" name="txt_date" class="form-control" placeholder="วันที่รายงานผล ...">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน</label>
                <div class="col-sm-6">
                    <select name="txt_subject_id" class="form-control">
                    <option value="" selected="selected"><?php echo $row['subject_id']; ?></option>
                    <?php foreach($result2 as $row2){?>
                
                    <option value="<?php echo $row2["subject_id"] ?>">
                    <?php
                            echo $row2['subject_id'];
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
                <textarea id="" name="txt_goal" rows="4" cols="95" value="<?php echo $row['goal'];?>">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">ผลการปฎิบัติงาน</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_result" rows="4" cols="95" value="<?php echo $row['result'];?>">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ดี</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_activity_good" rows="4" cols="95" value="<?php echo $row['activity_good'];?>">
                </textarea>
                </div>
                </div>
            </div>
            
            <br>
            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">กิจกรรมที่ทำได้ไม่ดี</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_activity_nogood" rows="4" cols="95" value="<?php echo $row['activity_nogood'];?>">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">ปัญหา/อุปสรรค</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_problem" rows="4" cols="95" value="<?php echo $row['problem'];?>">
                </textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">นักเรียน/กิจกรรมที่ต้องปรับปรุง</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_student" rows="4" cols="95" value="<?php echo $row['student'];?>">
                </textarea>
                </div>
                </div>
            </div>


            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">แนวทางการแก้ปัญหาหรือการปฎิบัติการครั้งต่อไป</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_solve_the_problem" rows="4" cols="95" value="<?php echo $row['solve_the_problem'];?>">
                </textarea>
                </div>
                </div>
            </div>

            <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="week.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>

        </form>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>