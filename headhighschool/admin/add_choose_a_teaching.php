<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    
    if(isset($_REQUEST['btn_insert'])){
        $name = $_REQUEST['txt_name'];
        $code= $_REQUEST['txt_code'];
        $grade_level = $_REQUEST['txt_grade'];
        $classroom = $_REQUEST['txt_classroom'];
        $id ;
        $time_name = $_REQUEST['txt_time'];
        $date = $_REQUEST['txt_date'];
        $year = $_REQUEST['txt_year'];

        if(empty($name)){
            $errorMsg = "กรุณาระบุชื่อคุณครู";
        }else if(empty($code)){
            $errorMsg = "กรุณาระบุรหัสวิชา และชื่อวิชา ";
        }else if(empty($classroom)){
            $errorMsg = "กรุณาระบุชั้นเรียน";
        }else {
           
                if(!isset($errorMsg)){
                    $sql = "INSERT INTO choose_a_teaching(master_id, grade_id, subject_id, class_id, time_id, date, year_id) VALUE('".$name."', '".$grade_level."', '".$code."', '".$classroom."', '".$time_name."', '".$date."', '".$year."')";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn);
                    //INSERT INTO `choose_a_teaching` (`choose_id`, `master_id`, `subject_id`, `class_id`, `status_choose`) VALUES (NULL, '41', '10', '14', 'Active');
                    

                    if($result){
                        echo "<script>";
                        echo "alert('สำเร็จ');";
                        echo "window.location ='choose_a_teaching.php'; ";
                        $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                        echo "</script>";
                        } else {
                        
                        echo "<script>";
                        echo "alert('ล้มเหลว!');";
                        echo "window.location ='choose_a_teaching.php'; ";
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
                <?php } ?>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>
        <br>

        <div class="form- text-center">
                <div class="row">
                <label for="name_classroom" class="col-sm-3 control-label">ระดับชั้น</label>
                <div class="col-sm-6">
                <select name="txt_grade" class="form-control" required>
                    <?php
                $query3 = "SELECT * FROM grade_level  ORDER BY grade_level.grade_level_user ASC ";
                $result3 = mysqli_query($conn, $query3);
                    ?>
                <option value="">-ระบุระดับชั้นเรียน-</option>
                    <?php foreach($result3 as $results3){
                        if( $results3["status_grade"] == 'Active'){?>
                    
                    <option value="<?php echo $results3["grade_id"];?>">
                    <?php echo '('.$results3["grade_level_user"].')  '.$results3["name_gradelevel"]; ?>
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
            <label for="type" class="col-sm-3 control-label">รหัสวิชา/วิชา</label>
            <div class="col-sm-6">
                <select name="txt_code" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php
                $query1 = "SELECT * FROM subject"; 
                $result1 = mysqli_query($conn,$query1);//subject
                ?>
                <?php foreach($result1 as $row1){
                    if($row1['status_subject'] == 'Active'){?>
                <option value="<?php echo $row1["subject_id"]; ?>">
                <?php echo $row1["code_subject"].' '.$row1["name_subject"]; ?>
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
            <label for="type" class="col-sm-3 control-label">ห้องเรียน</label>
            <div class="col-sm-6">
                <select name="txt_classroom" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php
                $query2 = "SELECT * FROM classroom as class, grade_level as grade WHERE class.grade_id = grade.grade_id ORDER BY class.class_id ASC ";
                $result2 = mysqli_query($conn,$query2);//classroom
                ?>
                <?php foreach($result2 as $row2){
                    if($row2['status_class'] == 'Active'){?>
                <option value="<?php echo $row2["class_id"]; ?>"><?php echo $row2["name_classroom"]; ?>
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
            <label for="type" class="col-sm-3 control-label">เวลาในการสอน</label>
            <div class="col-sm-6">
                <select name="txt_time" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php
                $query4 = "SELECT * FROM time ";
                $result4 = mysqli_query($conn,$query4);//classroom
                ?>
                <?php foreach($result4 as $row4){
                    if($row4['status_time'] == 'Active'){?>
                <option value="<?php echo $row4["time_id"]; ?>"><?php echo $row4["time_name"]; ?>
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
            <label for="type" class="col-sm-3 control-label">วันที่สอน</label>
            <div class="col-sm-6">
                <select name="txt_date" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <option value="วันจันทร์">วันจันทร์</option>
                <option value="วันอังคาร">วันอังคาร</option>
                <option value="วันพุธ">วันพุธ</option>
                <option value="วันพฤหัสบดี">วันพฤหัสบดี</option>
                <option value="วันศุกร์">วันศุกร์</option>
                </select>
            </div>
            </div>
        </div>
        <br>

        <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">ปีการศึกษา</label>
            <div class="col-sm-6">
                <select name="txt_year" class="form-control">
                <option value="" selected="selected">- กรุณาเลือก -</option>
                <?php
                $query4 = "SELECT * FROM year ";
                $result4 = mysqli_query($conn,$query4);//classroom
                ?>
                <?php foreach($result4 as $row4){
                    if($row4['status_year'] == 'Active'){?>
                <option value="<?php echo $row4["year_id"]; ?>"><?php echo $row4["term"].'/'.$row4["year_name"]; ?>
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
                    <input type="submit" name="btn_insert" class="btn btn-success" value="เพิ่มข้อมูล">
                    <a href="choose_a_teaching.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>

</div>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>