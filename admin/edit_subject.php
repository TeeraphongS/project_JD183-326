<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');

    if(isset($_REQUEST['update_id'])){

        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM  subject as sub,grade_level as grade  WHERE sub.grade_id = grade.grade_id AND sub.subject_id = '".$id."'";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        extract($row);
            /*$id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM subject WHERE subject_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);*/
        
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        $code_subject = $_REQUEST['txt_code_subject'];
        $name_subject = $_REQUEST['txt_name_subject'];
        $grade_level_user = $_REQUEST['txt_grade'];

        if(empty($code_subject)){
            $errorMsg = "กรุณากรอกรหัสวิชา";
        }else if(empty($name_subject)){
            $errorMsg = "กรุณากรอกชื่อวิชา";
        }else{
            
                if(!isset($errorMsg))
                $sql = "UPDATE subject SET grade_id = '".$grade_level_user."', code_subject = '".$code_subject."', name_subject ='".$name_subject."' 
                    WHERE subject_id = '".$id."' ";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

                    if($result){
                        echo "<script type='text/javascript'>";
                        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
                        echo "window.location = 'subject.php'; ";
                        echo "</script>";
                        }
                        else{
                        echo "<script type='text/javascript'>";
                        echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
                        echo "</script>";
                                
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
    <div class="display-3 text-center">แก้ไข</div>
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
                <label for="name_classroom" class="col-sm-3 control-label">ระดับชั้น</label>
                <div class="col-sm-6">
                <select name="txt_grade" class="form-control" required>
                    <?php
                $query1 = "SELECT * FROM grade_level ";
                $result1 = mysqli_query($conn, $query1);
                    ?>
                <option value="<?php echo $grade_id; ?>"><?php echo '('.$grade_level_user.')  '.$name_gradelevel;  ?></option>
                    <?php foreach($result1 as $results1){
                        if( $results1["status_grade"] == 'Active' && $results1['grade_id'] !== $grade_id){?>
                    
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
                <label for="code_subject" class="col-sm-3 control-label">รหัสวิชา</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_code_subject" class="form-control" value="<?php echo $code_subject; ?>">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">ชื่อวิชา</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_subject" class="form-control" value="<?php echo $name_subject; ?>">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
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