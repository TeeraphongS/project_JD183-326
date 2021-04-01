<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $code_subject = $_REQUEST['txt_code_subject'];
        $name_subject = $_REQUEST['txt_name_subject'];

        if(empty($code_subject)){
            $errorMsg = "PLEASE ENTER CODE SUBJECT";
        }else if (empty($name_subject)){
            $errorMsg = "PLEASE ENTER NAME SUBJECT";
        }else{
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO subject_user(code_subject , name_subject) VALUE(:code, :name) ");
                    $insert_stmt->bindParam(":code", $code_subject);
                    $insert_stmt->bindParam(":name", $name_subject);

                    if($insert_stmt->execute()){
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2,subject.php");
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
    <title>Add Subject</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    
    <div class="container">
    <div class="display-3 text-center">Add+</div>

    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>

    <?php
        if(isset($insertrMsg)){
    ?>
        <div class="alert alert-success">
            <strong>Success <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="codesubject" class="col-sm-3 control-label">Code Subject</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_code_subject" class="form-control" placeholder="Enter Code Subject...">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="namesubject" class="col-sm-3 control-label">Name Subject</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_subject" class="form-control" placeholder="Enter Name Subject...">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="subject.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>


   


    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>