<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }

    require_once('../connection.php');
    

    if(isset($_REQUEST['update_id'])){
        //2. query ข้อมูลจากตาราง:
        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM  time, year WHERE time.year_id = year.year_id AND time_id = '".$id."' ";
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
        $time_name_up = $_REQUEST['txt_time_name'];
        $year_up = $_REQUEST['txt_year'];
        

        if(empty($time_name_up)){
            $errorMsg = "กรุณากรอกเวลาในการทำงาน";
        }else{
                if(!isset($errorMsg))
                    $sql = "UPDATE time SET time_name = '".$time_name_up."',year_id = '".$year_up."' WHERE time_id = '".$id."'";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
        echo "<script type='text/javascript'>";
        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
        echo "window.location = 'time.php.'; ";
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
    <title>หน้าแก้ไขข้อมูลเวลาในการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">หน้าแก้ไขเวลาในการสอน</div>
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
                    <label for="firstname" class="col-sm-3 control-label">เวลาในการสอน</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_time_name" class="form-control" value="<?php echo $time_name; ?>">
                    </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                    <label for="type" class="col-sm-3 control-label">ปีการศึกษา</label>
                    <div class="col-sm-6">
                        <select name="txt_year" class="form-control">
                            <option value="<?php echo $year_id; ?>" selected="selected">
                                <?php echo $term.'/'.$year_name; ?></option>
                            <?php
                $query2 = "SELECT * FROM year"; 
                $result2 = mysqli_query($conn,$query2);//subject
                ?>
                            <?php foreach($result2 as $row2){
                    if($row2['status_year'] == 'Active' && $row2['year_id'] !== $year_id){?>
                            <option value="<?php echo $row2["year_id"]; ?>">
                            <?php echo $row2["term"].'/'.$row2["year_name"]; ?>
                            </option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>




            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="time.php." class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>





    <script src="js/slime.js">
    < /> <
    script src = "js/popper.js" >
    </script>
    <script src="js/bootstrap.js"></script>

</body>

</html>