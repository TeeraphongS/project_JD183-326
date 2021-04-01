<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('connection.php');
    $query = "SELECT * FROM subject_user";
    $query1 = "SELECT * FROM classroom_user";
    $query2 = "SELECT * FROM masterlogin";

    $result = mysqli_query($conn,$query);
    $result1 = mysqli_query($conn,$query1);
    $result2 = mysqli_query($conn,$query2);
    if(isset($_REQUEST['btn_insert'])){
        $name = $_REQUEST['txt_name'];
        $code= $_REQUEST['txt_code'];
        $classroom = $_REQUEST['txt_classroom'];
        $id ;

        if(empty($name)){
            $errorMsg = "Please enter Firstname";
        }else if(empty($code)){
            $errorMsg = "Please enter Code code";
        }else if(empty($classroom)){
            $errorMsg = "Please enter Classroom";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO choose_a_teaching(master_id,subject_id,class_id) VALUE(:master,:code,:classroom)");
                    $insert_stmt->bindParam(":master", $name);

                    $insert_stmt->bindParam(":code", $code);
                    $insert_stmt->bindParam(":classroom", $classroom);
                    

                    if($insert_stmt->execute()){
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2,choose_a_teaching.php");
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
    <title>เพิ่มวิชาการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    <div class="container">
    <div class="display-3 text-center">เพิ่มวิชาการสอน</div>
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
            <label for="type" class="col-sm-3 control-label">ชื่อ</label>
            <div class="col-sm-6">
                <select name="txt_name" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php foreach($result2 as $row2){?>
                <option value="<?php echo $row2["master_id"]; ?>">
                <?php echo $row2["fname"].' '.$row2["lname"]; ?>
                </option>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>
            
            

            <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">รหัสวิชา/วิชา</label>
            <div class="col-sm-6">
                <select name="txt_code" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php foreach($result as $row){?>
                <option value="<?php echo $row["subject_id"]; ?>">
                <?php echo $row["code_subject"].''.$row["name_subject"]; ?>
                </option>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>

        

        <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">ห้องเรียน</label>
            <div class="col-sm-6">
                <select name="txt_classroom" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php foreach($result1 as $row1){?>
                <option value="<?php echo $row1["class_id"]; ?>">
                <?php echo $row1["name_classroom"]; ?>
                </option>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>



        


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="choose_a_teaching.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>