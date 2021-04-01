<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('connection.php');

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM masterlogin WHERE master_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){
        $firstname_up = $_REQUEST['txt_firstname'];
        $lastname_up = $_REQUEST['txt_lastname'];
        $username_up = $_REQUEST['txt_username'];
        $password_up = $_REQUEST['txt_password'];
        $email_up = $_REQUEST['txt_email'];
        $role_up = $_REQUEST['txt_role'];
        $status;
        
        

        if(empty($firstname_up)){
            $errorMsg = "Please enter Firstname";
        }else if(empty($lastname_up)){
            $errorMsg = "Please enter Lastname";
        }else if(empty($username_up)){
            $errorMsg = "Please enter Username";
        }else if(empty($password_up)){
            $errorMsg = "Please enter Password";
        }else if(empty($email_up)){
            $errorMsg = "Please enter Email";
        }else if(empty($role_up)){
            $errorMsg = "Please enter Role";
        }else{
            try{
                if(!isset($errorMsg))
                    $update_stmt = $db->prepare("UPDATE masterlogin SET fname = :fname_up,lname = :lname_up,username = :user_up, password = :pass_up,email= :email_up, user_role_id = :role_up  WHERE master_id = :id");
                    $update_stmt->bindParam(':fname_up', $firstname_up);
                    $update_stmt->bindParam(':lname_up', $lastname_up);
                    $update_stmt->bindParam(':user_up', $username_up);
                    $update_stmt->bindParam(':pass_up', $password_up);
                    $update_stmt->bindParam(':email_up', $email_up);
                    $update_stmt->bindParam(':role_up', $role_up);
                    $update_stmt->bindParam(':id', $id);

                    if($update_stmt->execute()){
                        $updateMeg = "Record update successfully...";
                        header("refresh:2,index.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
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
                <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_firstname" class="form-control" value="<?php echo $fname; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_lastname" class="form-control" value="<?php echo $lname; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="username" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_username" class="form-control" value="<?php echo $username; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" name="txt_password" class="form-control" value="<?php echo $password; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_email" class="form-control" value="<?php echo $email; ?>">
                </div>
                </div>
            </div>

            <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">Select Type</label>
            
            <div class="col-sm-6">
                <select id="list"name="txt_role" class="form-control">
                    <option value="1"<?php if($user_role_id==1){echo "selected";} ?>>ผู้ดูแลระบบ</option>
                    <option value="2"<?php if($user_role_id==2){echo "selected";} ?>>ผู้อำนวยการ</option>
                    <option value="3"<?php if($user_role_id==3){echo "selected";} ?> >รองผู้อำนวยการ ฝ่ายวิชาการ</option>
                    <option value="4"<?php if($user_role_id==4){echo "selected";} ?>>ฝ่ายวิชาการ</option>
                    <option value="5"<?php if($user_role_id==5){echo "selected";} ?>>ครู</option>
                </select>

            </div>
            </div>
        </div>
        
        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                        <a href="change_status.php?change_id=<?php echo $row["master_id"]; ?>" class="btn btn-info " onclick="return confirm('คุณต้องการเปลี่ยนสถานะของผู้ใช้หรือไม่')">Change Status</a>
                    </div>
                </div>
        

        


            
            

        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    
</body>
</html>