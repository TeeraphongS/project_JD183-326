<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM classroom WHERE class_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        $name_classroom = $_REQUEST['txt_name_classroom'];

        if(empty($name_classroom)){
            $errorMsg = "Please Enter Classroom";
        }else{
            try{
                if(!isset($errorMsg))
                    $update_stmt = $db->prepare("UPDATE classroom SET  name_classroom = :classroom WHERE class_id = :id");
                    $update_stmt->bindParam(':classroom', $name_classroom);
                    $update_stmt->bindParam(':id', $id);

                    if($update_stmt->execute()){
                        $updateMeg = "บันทึกข้อมูลการอัพเดตเสร็จสิ้น";
                        header("refresh:2,classroom.php");
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
    <title>หน้าแก้ไขชั้นเรียน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">แก้ไขชั้นเรียน</div>
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
                <label for="name_classroom" class="col-sm-3 control-label">ชื่อชั้นเรียน</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_classroom" class="form-control" value="<?php echo $name_classroom; ?>">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="เปลี่ยนข้อมูล">
                    <a href="classroom.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>