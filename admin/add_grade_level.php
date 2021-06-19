<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $name_gradelevel = $_REQUEST['txt_gradelevel'];

        if(empty($name_gradelevel)){
            $errorMsg = "กรุณากรอกชื่อระดับชั้น";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO grade_level(name_gradelevel) VALUE(:gradelevel) ");
                    $insert_stmt->bindParam(":gradelevel", $name_gradelevel);

                    if($insert_stmt->execute()){
                        $insertMsg = "เพิ่มข้อมูลของระดับชั้นเสร็จสิ้น";
                        header("refresh:1,grade_level.php");
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
    <title>เพิ่มระดับชั้นเรียน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มระดับชั้นเรียน</div>

    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
            <strong>เกิดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>

    <?php
        if(isset($insertrMsg)){
    ?>
        <div class="alert alert-success">
            <strong>ดำเนินการเสร็จสิ้น <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="name_gradelevel" class="col-sm-3 control-label">ชื่อระดับชั้น</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_gradelevel" class="form-control" placeholder="ชื่อระดับชั้น...">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
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