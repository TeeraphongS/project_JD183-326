<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $code_subject = $_REQUEST['txt_code_subject'];
        $name_subject = $_REQUEST['txt_name_subject'];
        $grade = $_REQUEST['txt_grade'];

        if(empty($code_subject)){
            $errorMsg = "กรุณากรอกรหัสวิชา";
        }else if (empty($name_subject)){
            $errorMsg = "กรุณากรอกชื่อวิชา";
        }else{
            
                if(!isset($errorMsg)){
                    $sql ="INSERT INTO subject(grade_id, code_subject, name_subject) VALUE('".$grade."', '".$code_subject."', '".$name_subject."') ";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn);

                    if($result){
                        echo "<script>";
                        echo "alert('สำเร็จ');";
                        echo "window.location ='subject.php'; ";
                        $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                        echo "</script>";
                        } else {
                        
                        echo "<script>";
                        echo "alert('ล้มเหลว!');";
                        echo "window.location ='subject.php'; ";
                        echo "</script>";
                        }
                }
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มวิชา</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มวิชา</div>

    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
            <strong>เกืดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
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
                $query1 = "SELECT * FROM grade_level ";
                $result1 = mysqli_query($conn, $query1);
                    ?>
                <option value="">-ระบุระดับชั้นเรียน-</option>
                    <?php foreach($result1 as $results1){
                        if( $results1["status_grade"] == 'Active'){?>
                    
                    <option value="<?php echo $results1["grade_id"];?>">
                    <?php echo '('.$results1["grade_level_user"].')  '.$results1["name_gradelevel"]; ?>
                    </option>
                    <?php } ?>
                    <?php } ?>
                </select>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="codesubject" class="col-sm-3 control-label">รหัสวิชา</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_code_subject" class="form-control" placeholder="รหัสวิชา...">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="namesubject" class="col-sm-3 control-label">ชื่อวิชา</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_subject" class="form-control" placeholder="ชื่อวิชา...">
                </div>
                </div>
            </div>
            <br>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
                    <a href="subject.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
</div>

   


    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>