<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    
    if(isset($_REQUEST['btn_insert'])){
        $name = $_REQUEST['txt_name'];
        $code= $_REQUEST['txt_code'];
        $classroom = $_REQUEST['txt_classroom'];
        $id ;

        if(empty($name)){
            $errorMsg = "กรุณาระบุชื่อคุณครู";
        }else if(empty($code)){
            $errorMsg = "กรุณาระบุรหัสวิชา และชื่อวิชา ";
        }else if(empty($classroom)){
            $errorMsg = "กรุณาระบุชั้นเรียน";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO choose_a_teaching(master_id, subject_id, class_id) VALUE(:master, :code, :classroom)");
                    //INSERT INTO `choose_a_teaching` (`choose_id`, `master_id`, `subject_id`, `class_id`, `status_choose`) VALUES (NULL, '41', '10', '14', 'Active');
                    $insert_stmt->bindParam(":master", $name);
                    $insert_stmt->bindParam(":code", $code);
                    $insert_stmt->bindParam(":classroom", $classroom);
                    

                    if($insert_stmt->execute()){
                        $insertMsg = "เพิ่มข้อมูลของหน้าที่อาจารย์เสร็จสิ้น";
                        header("refresh:1,choose_a_teaching.php");
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
    <title>เพิ่มวิชาการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มหน้าที่ครู</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>เกิดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
        if(isset($insertMsg)){
    ?>
        <div class="alert alert-success">
        <strong>ดำเนินการเสร็จสิ้น <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
    <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">ชื่อ</label>
            <div class="col-sm-6">
                <select name="txt_name" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php 
                $query = "SELECT * FROM login_information";
                $result = mysqli_query($conn,$query);//login data
                ?>
                <?php foreach($result as $row){
                    if($row['master_id'] == $row['master_id'] && $row['status_master'] == 'Active' && $row['user_role_id'] == '5'){?>
                <option value="<?php echo $row["master_id"]; ?>">
                <?php echo $row["fname"].' '.$row["lname"]; ?>
                </option>
                <?php }else {
                    # code...
                } ?>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>
            
            

            <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">รหัสวิชา/วิชา</label>
            <div class="col-sm-6">
                <select name="txt_code" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php
                $query1 = "SELECT * FROM subject"; 
                $result1 = mysqli_query($conn,$query1);//subject
                ?>
                <?php foreach($result1 as $row1){
                    if($row1['status'] == 'Active'){?>
                <option value="<?php echo $row1["subject_id"]; ?>">
                <?php echo $row1["code_subject"].' '.$row1["name_subject"]; ?>
                </option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>

        

        <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">ห้องเรียน</label>
            <div class="col-sm-6">
                <select name="txt_classroom" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php
                $query2 = "SELECT * FROM classroom";
                $result2 = mysqli_query($conn,$query2);//classroom
                ?>
                <?php foreach($result2 as $row2){
                    if($row2['status'] == 'Active'){?>
                <option value="<?php echo $row2["class_id"]; ?>">
                <?php echo $row2["name_classroom"]; ?>
                </option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>



        


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="choose_a_teaching.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

</div>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>