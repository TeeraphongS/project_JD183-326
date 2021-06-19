<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM grade_level WHERE grade_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        $name_gradelevel = $_REQUEST['txt_name_gradelevel'];

        if(empty($name_gradelevel)){
            $errorMsg = "กรุณากรอกชื่อระดับชั้น";
        }else{
            try{
                if(!isset($errorMsg))
                    $update_stmt = $db->prepare("UPDATE grade_level SET  name_gradelevel = :name_gradelevel WHERE grade_id = :id");
                    $update_stmt->bindParam(':name_gradelevel', $name_gradelevel);
                    $update_stmt->bindParam(':id', $id);

                    if($update_stmt->execute()){
                        $updateMeg = "บันทึกข้อมูลการอัพเดตเสร็จสิ้น";
                        header("refresh:1,grade_level.php");
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
    <title>หน้าแก้ไขข้อมูลระดับชั้น</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">แก้ไขระดับชั้น</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>เกิดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
        if(isset($updateMeg)){
    ?>
        <div class="alert alert-success">
        <strong>ดำเนินการเสร็จสิ้น <?php echo $updateMeg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="name_gradelevel" class="col-sm-3 control-label">ชื่อระดับชั้น</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_gradelevel" class="form-control" value="<?php echo $name_gradelevel; ?>">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="เปลี่ยนข้อมูล">
                    <a href="grade_level.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>