<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');
    

    if(isset($_REQUEST['update_id'])){
        //2. query ข้อมูลจากตาราง:
        $id = $_REQUEST['update_id'];
        $sql = "SELECT * FROM  year WHERE year_id = '".$id."' ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        extract($row);
            /*$id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM login_information as login, user_role as role WHERE login.master_id = '".$id."' AND login.user_role_id = role.user_role_id ");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            */
        
    }
    if(isset($_REQUEST['btn_update'])){
        $year_name_up = $_REQUEST['txt_year'];
        $term_up = $_REQUEST['txt_term'];
        
        

        if(empty($year_name_up)){
            $errorMsg = "กรุณากรอกปรการศึกษา";
        }else if(empty($term_up)){
            $errorMsg = "กรุณากรอกเทอมการศึกษา";
        }else{
                if(!isset($errorMsg))
                    $sql = "UPDATE year SET year_name = '".$year_name_up."' ,term = '".$term_up."',
                    status_year = 'Active' WHERE year_id = '".$id."'";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
        echo "<script type='text/javascript'>";
        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
        echo "window.location = 'year.php'; ";
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
    <title>หน้าแก้ไขข้อมูลสมาชิก</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">หน้าแก้ไขข้อมูลสมาชิก</div>
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
                <label for="firstname" class="col-sm-3 control-label">ปีการศึกษา</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_year" class="form-control" placeholder="ตัวอย่าง 2021" value="<?php echo $year_name; ?>">
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">เทอมการศึกษา</label>
            <div class="col-sm-6">
                <select name="txt_term" class="form-control">
                <option value="<?php echo $term; ?>" selected="selected"><?php echo $term; ?></option>
                <?php if($row['status_year']=='Active' && $row['term'] !== $term){ ?>
                <option value="<?php echo $row['year_id']; ?>"><?php echo $row['term']; ?></option>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>
        <br>
        


        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="year.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>
    




    <script src="js/slime.js"></>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>