<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM login_information as login, user_role as role WHERE login.master_id = '".$id."' AND login.user_role_id = role.user_role_id ");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }
    if(isset($_REQUEST['btn_update'])){
        $firstname_up = $_REQUEST['txt_firstname'];
        $lastname_up = $_REQUEST['txt_lastname'];
        $username_up = $_REQUEST['txt_username'];
        $password_up = $_REQUEST['txt_password'];
        $email_up = $_REQUEST['txt_email'];
        $role_up = $_REQUEST['txt_role'];
        $status;
        $id = $_REQUEST['update_id'];
        
        

        if(empty($firstname_up)){
            $errorMsg = "กรุณากรอกชื่อ";
        }else if(empty($lastname_up)){
            $errorMsg = "กรุณากรอกนามสกุล";
        }else if(empty($username_up)){
            $errorMsg = "กรุณากรอกชื่อบัญชีผู้ใช้";
        }else if(empty($password_up)){
            $errorMsg = "กรุณากรอกรหัสผ่าน";
        }else if(empty($email_up)){
            $errorMsg = "กรุณากรอกอีเมลล์";
        }else if(empty($role_up)){
            $errorMsg = "กรุณาระบุบทบาท";
        }else{
            try{
                if(!isset($errorMsg))
                    $update_stmt = $db->prepare("UPDATE login_information SET fname = '".$firstname_up."' ,lname = '".$lastname_up."',
                    username = '".$username_up."', password = '".$password_up."',email= '".$email_up."', user_role_id = '".$role_up."' 
                    WHERE master_id = '".$id."'");

                    if($update_stmt->execute()){
                        $updateMeg = "การอัพเดตข้อมูลดำเนินการเสร็จสิ้น";
                        header("refresh:1,index.php");
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
                <label for="firstname" class="col-sm-3 control-label">ชื่อ</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_firstname" class="form-control" value="<?php echo $fname; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lname; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="username" class="col-sm-3 control-label">ชื่อบัญชีผู้ใช้</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_username" class="form-control" value="<?php echo $username; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="password" class="col-sm-3 control-label">รหัสผ่าน</label>
                <div class="col-sm-6">
                    <input type="password" name="txt_password" class="form-control" value="<?php echo $password; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="email" class="col-sm-3 control-label">อีเมลล์</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_email" class="form-control" value="<?php echo $email; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">บทบาท</label>
                <div class="col-sm-6">
                    <select name="txt_role" class="form-control">
                    <?php 
                    $query = ("SELECT * FROM user_role ");
                    $result =mysqli_query($conn,$query);
                     ?>
                   <option value="<?php echo $name_role;?>" selected="selected"><?php echo $name_role;?></option>
                    <?php foreach($result as $row){
                        if($row['status']=='Active'){?>
                           <option value="<?php echo $row["user_role_id"];?>">
                           <?php echo $row['name_role']; ?></option>
                    </option>
                    <?php }?>
                    <?php } ?>
                    </select>
                </div>
                </div>
            </div>
             
        


        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>
    




    <script src="js/slime.js"></>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
</html>