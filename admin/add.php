<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];
        $username = $_REQUEST['txt_username'];
        $password = $_REQUEST['txt_password'];
        $email = $_REQUEST['txt_email'];
        $role = $_REQUEST['txt_role'];

        if(empty($firstname)){
            $errorMsg = "Please enter Firstname";
        }else if(empty($lastname)){
            $errorMsg = "Please enter Lastname";
        }else if(empty($username)){
            $errorMsg = "Please enter username";
        }else if(empty($password)){
            $errorMsg = "Please enter password";
        }else if(empty($email)){
            $errorMsg = "Please enter email";
        }else if(empty($role)){
            $errorMsg = "Please enter role";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO masterlogin(fname,lname,username,password,email,user_role_id) VALUE(:fname,:lname,:user,:pass,:email,:role) ");
                    $insert_stmt->bindParam(":fname", $firstname);
                    $insert_stmt->bindParam(":lname", $lastname);
                    $insert_stmt->bindParam(":user", $username);
                    $insert_stmt->bindParam(":pass", $password);
                    $insert_stmt->bindParam(":email", $email);
                    $insert_stmt->bindParam(":role", $role);

                    if($insert_stmt->execute()){
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2,index.php");
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
    <title>เพิ่มบุคลากร</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    <div class="container">
    <div class="display-3 text-center">Add+</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
        if(isset($insertMsg)){
    ?>
        <div class="alert alert-success">
        <strong>success <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_firstname" class="form-control" placeholder="Enter Firstname...">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_lastname" class="form-control" placeholder="Enter Lastname...">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="username" class="col-sm-3 control-label">username</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_username" class="form-control" placeholder="Enter Username...">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="password" class="col-sm-3 control-label">password</label>
                <div class="col-sm-6">
                    <input type="password" name="txt_password" class="form-control" placeholder="Enter Password...">
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_email" class="form-control" placeholder="Enter Email...">
                </div>
                </div>
            </div>

            <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">Select Type</label>
            <div class="col-sm-6">
                <select name="txt_role" class="form-control">
                <option value="" selected="selected">- ระบุตำแหน่ง -</option>
                    <option value="1">ผู้ดูแลระบบ</option>
                    <option value="2">ผู้อำนวยการ</option>
                    <option value="3">รองผู้อำนวยการ ฝ่ายวิชาการ</option>
                    <option value="4">ฝ่ายวิชาการ</option>
                    <option value="5">ครู</option>
                </select>
            </div>
            </div>
        </div>

        


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>