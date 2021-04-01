<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('connection.php');

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM subject_user WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        $code_subject = $_REQUEST['txt_code_subject'];
        $name_subject = $_REQUEST['txt_name_subject'];

        if(empty($code_subject)){
            $errorMsg = "Please Enter Code";
        }else if(empty($name_subject)){
            $errorMsg = "Please Enter Name";
        }else{
            try{
                if(!isset($errorMsg))
                    $update_stmt = $db->prepare("UPDATE subject_user SET  code_subject = :code, name_subject =:name WHERE id = :id");
                    $update_stmt->bindParam(':code', $code_subject);
                    $update_stmt->bindParam(':name', $name_subject);
                    $update_stmt->bindParam(':id', $id);

                    if($update_stmt->execute()){
                        $updateMeg = "Record update successfully...";
                        header("refresh:2,subject.php");
                    }
            } catch(PDOException $e){
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
    <title>Edit Subject</title>
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
                <label for="code_subject" class="col-sm-3 control-label">Code Subject</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_code_subject" class="form-control" value="<?php echo $code_subject; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">Name Subject</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_subject" class="form-control" value="<?php echo $name_subject; ?>">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="subject.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>