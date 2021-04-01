<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $name_gradelevel = $_REQUEST['txt_gradelevel'];

        if(empty($name_gradelevel)){
            $errorMsg = "PLEASE ENTER GRADE LEVEL";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO grade_level_user(name_gradelevel) VALUE(:gradelevel) ");
                    $insert_stmt->bindParam(":gradelevel", $name_gradelevel);

                    if($insert_stmt->execute()){
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2,grade_level.php");
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
    <title>Add+ Grade level</title>
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
                <label for="name_gradelevel" class="col-sm-3 control-label">Name Grade Level</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_gradelevel" class="form-control" placeholder="Enter Grade Level...">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="grade_level.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>


   


    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>