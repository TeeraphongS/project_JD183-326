<?php 
    include_once('connection.php');
    session_start();

    if (isset($_SESSION['admin_login'])) {
        header("location: admin/admin_home.php");
    }

    if (isset($_SESSION['director_login'])) {
        header("location: director/director_home.php");
    }

    if (isset($_SESSION['deputydirector_login'])) {
        header("location: deputydirector/deputydirector_home.php");
    }

    if (isset($_SESSION['academicdepartment_login'])) {
        header("location: academicdepartment/academicdepartment_home.php");
    }
    
    if (isset($_SESSION['teacher_login'])) {
        header("location: teacher/teacher_home.php");
    }

    if (isset($_SESSION['headprimary_login'])) {
        header("location: headprimary/headprimary_home.php");
    }

    if (isset($_SESSION['headhighschool_login'])) {
        header("location: headhighschool/headhighschool_home.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1 class="mt-5">เข้าสู่ระบบ</h1>
        <hr>

        <?php if(isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <h3>
                <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
            </h3>
        </div>
        <?php endif ?>

        <?php if(isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger">
            <h3>
                <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
            </h3>
        </div>
        <?php endif ?>

        <form action="login_db.php" method="post" class="form-horizontal my-5">

            <label for="username" class="col-sm-3 control-label">ชื่อบัญชีผู้ใช้</label>
            <div class="col-sm-12">
                <input type="text" name="txt_username" class="form-control" required placeholder="ชื่อบัญชีผู้ใช้...">
            </div>

            <label for="password" class="col-sm-3 control-label">รหัสผ่าน</label>
            <div class="col-sm-12">
                <input type="password" name="txt_password" class="form-control" required placeholder="รหัสผ่าน">
            </div>

            

            <?php
                $query = "SELECT * FROM user_role ORDER BY user_role_id asc" or die("Error:" . mysqli_error());
                $result = mysqli_query($conn, $query);
            ?>
            <label for="username" class="col-sm-3 control-label">บทบาทผู้ใช้</label>
            <div class="col-sm-12">
                <select name="txt_role" class="form-control" required>
                    <option value="">-ระบุตำแหน่ง-</option>
                    <?php foreach($result as $results){
                        if($results['status_role'] == 'Active'){?>
                    <option value="<?php echo $results["user_role_id"];?>">
                        <?php echo $results["name_role"]; ?>
                    </option>
                    <?php }else {
                        # code...
                    } ?>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <div class="col-sm-12 mt-3">
                    <input type="submit" name="btn_login" class="btn btn-success" style="width: 100%;" value="เข้าสู่ระบบ">
                </div>
            </div>


        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>

</html>