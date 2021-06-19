<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $grade_level = $_REQUEST['txt_grade'];
        $name_classroom = $_REQUEST['txt_classroom'];

        if(empty($name_classroom)){
            $errorMsg = "กรุณากรอกข้อมูลชื่อชั้นเรียน";
        }else{
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO classroom(grade_id, name_classroom) VALUE(:grade, :class) ");
                    $insert_stmt->bindParam(":grade", $grade_level);
                    $insert_stmt->bindParam(":class", $name_classroom);

                    if($insert_stmt->execute()){
                        $insertMsg = "เพิ่มข้อมูลชั้นเรียนเสร็จสิ้น";
                        header("refresh:1,classroom.php");
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
    <title>หน้าเพื่มชั้นเรียน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มชั้นเรียน</div>

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
                <label for="name_classroom" class="col-sm-3 control-label">ระดับชั้น</label>
                <div class="col-sm-6">
                <select name="txt_grade" class="form-control" required>
                    <?php
                $query = "SELECT * FROM grade_level ";
                $result = mysqli_query($conn, $query);
                    ?>
                <option value="">-ระบุระดับชั้นเรียน-</option>
                    <?php foreach($result as $results){
                        if($results["grade_id"] = $results["grade_id"] AND $results["status"] == 'Active'){?>
                    
                    <option value="<?php echo $results["grade_id"];?>">
                        <?php echo $results["name_gradelevel"]; ?>
                    </option>
                    <?php } ?>
                    <?php } ?>
                </select>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_classroom" class="col-sm-3 control-label">ชื่อชั้นเรียน</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_classroom" class="form-control" placeholder="ชื่อชั้นเรียน...">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
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