<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');

    if(isset($_REQUEST['update_id'])){

        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM  user_role WHERE user_role_id = '".$id."'";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        extract($row);
        
            /*$id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM user_role WHERE user_role_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);*/
        
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up
        $name_role = $_REQUEST['txt_name_role'];

        if(empty($name_role)){
            $errorMsg = "กรุณากรอกชื่อบทบาท";
        }else{
            
                if(!isset($errorMsg))
                $sql = "UPDATE user_role SET  name_role = '".$name_role."' WHERE user_role_id = '".$id."'";
                $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                mysqli_close($conn); //ปิดการเชื่อมต่อ database 
            
        }
        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
            echo "window.location = 'role_type.php'; ";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
            echo "</script>";
                    
                }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแก้ไขข้อมูลบทบาท</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">หน้าแก้ไขข้อมูลบทบาท</div>
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
                <label for="name_role" class="col-sm-3 control-label">ชื่อบทบาท</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_role" class="form-control" value="<?php echo $name_role; ?>">
                </div>
                </div>
            </div>

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="role_type.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>