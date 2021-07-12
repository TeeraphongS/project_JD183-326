<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('../connection.php');
    $id1 = $_SESSION['UserID'];


    if(isset($_REQUEST['update_id'])){
        
        $id = $_REQUEST['update_id'];

        $sql = "SELECT * FROM choose_a_teaching as c,login_information as m , subject as sub, classroom as class, grade_level as grade
        WHERE c.choose_id = '".$id."' and c.master_id = m.master_id and c.subject_id = sub.subject_id and c.class_id = class.class_id and c.grade_id = grade.grade_id ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        extract($row);
            /*$id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM choose_a_teaching as c,login_information as m , subject as sub, classroom as class 
            WHERE c.choose_id = :id and c.master_id = m.master_id and c.subject_id = sub.subject_id and c.class_id = class.class_id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);*/
        
    }if(isset($_REQUEST['btn_update'])){
        $code_up = $_REQUEST['txt_code'] ;
        $classroom_up = $_REQUEST['txt_classroom'];
        $grade_level_user = $_REQUEST['txt_grade'];
        $status;
        
        

        
        if(empty($code_up)){
            $errorMsg = "Please enter Code";
        }else if(empty($classroom_up)){
            $errorMsg = "Please enter Classroom";
        }else{
            
                if(!isset($errorMsg))
                    $sql = "UPDATE choose_a_teaching SET  grade_id = '".$grade_level_user."', subject_id = '".$code_up."', class_id = '".$classroom_up."' ,
                    status_choose='Active' WHERE choose_id = '".$id."' ";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

                    if($result){
                        echo "<script type='text/javascript'>";
                        echo "alert('อัพเดตข้อมูลเสร็จสิ้น');";
                        echo "window.location = 'choose_a_teaching.php'; ";
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
    <title>แก้ไขวิชาการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">แก้ไขวิชาการสอน</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>เกิดข้อผิดพลาด <?php echo $errorMsg; ?></strong>
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
            <label for="type" class="col-sm-3 control-label">ชื่อ</label>
            <div class="col-sm-6">
                <select name="txt_name" class="form-control">
                <option value="<?php echo $master_id; ?>" ><?php echo $fname .' '.$lname; ?></option>
                <?php 
                $query1 = "SELECT * FROM login_information";
                $result1 = mysqli_query($conn,$query1);//login data
                ?>
                <?php foreach($result1 as $row1){
                    if($row1['status_master'] == 'Active' && $row1['user_role_id'] == '5' && row1['master_id'] !== $master_id){?>
                <option value="<?php echo $row1["master_id"]; ?>">
                <?php echo $row1["fname"].' '.$row1["lname"]; ?>
                </option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>
        <div class="form- text-center">
        <div class="row">
                <label for="name_classroom" class="col-sm-3 control-label">ระดับชั้น</label>
                <div class="col-sm-6">
                <select name="txt_grade" class="form-control" required>
                    <?php
                $query1 = "SELECT * FROM grade_level ";
                $result1 = mysqli_query($conn, $query1);
                    ?>
                <option value="<?php echo $grade_id; ?>"><?php echo '('.$grade_level_user.')  '.$name_gradelevel; ?></option>
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
            

       
        <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">รหัสวิชา/วิชา</label>
            <div class="col-sm-6">
                <select name="txt_code" class="form-control">
                <option value="<?php echo $subject_id; ?>" selected="selected"><?php echo $code_subject.''.$name_subject; ?></option>
                <?php
                $query2 = "SELECT * FROM subject"; 
                $result2 = mysqli_query($conn,$query2);//subject
                ?>
                <?php foreach($result2 as $row2){
                    if($row2['status_subject'] == 'Active' && $row2['subject_id'] !== $subject_id){?>
                <option value="<?php echo $row2["subject_id"]; ?>">
                <?php echo $row2["code_subject"].' '.$row2["name_subject"]; ?>
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
                <option value="<?php echo $class_id; ?>" selected="selected"><?php echo $name_classroom;?></option>
                <?php 
                $query3 = "SELECT * FROM classroom";
                $result3 = mysqli_query($conn,$query3);//classroom
                ?>
                <?php foreach($result3 as $row3){
                    if($row3['status_class'] == 'Active' && row3['class_id'] !== $class_id){?>
                <option value="<?php echo $row3["class_id"]; ?>">
                <?php echo $row3["name_classroom"]; ?>
                </option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>

        <div class="form- text-center">
    

    
        
        
        

        


            
            

        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="อัพเดต">
                    <a href="choose_a_teaching.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
    </div>

    




    <script src="js/slime.js"></>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    
</body>
</html>