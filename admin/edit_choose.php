<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('connection.php');

    $query = "SELECT * FROM subject_user";
    $query1 = "SELECT * FROM classroom_user";
    $query2 = "SELECT * FROM masterlogin";
    $query3 = "SELECT * FROM choose_a_teaching";

    $result = mysqli_query($conn,$query);
    $result1 = mysqli_query($conn,$query1);
    $result2 = mysqli_query($conn,$query2);
    $result3 = mysqli_query($conn,$query3);

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM choose_a_teaching as c, masterlogin as m , subject_user as sub, classroom_user as class 
            WHERE c.choose_id = :id and c.master_id = m.master_id and c.subject_id = sub.subject_id and c.class_id = class.class_id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){
        $code_up = $_REQUEST['txt_code'] ;
        $classroom_up = $_REQUEST['txt_classroom'];
        $status;
        
        

        
        if(empty($code_up)){
            $errorMsg = "Please enter Code";
        }else if(empty($classroom_up)){
            $errorMsg = "Please enter Classroom";
        }else{
            try{
                if(!isset($errorMsg))
                    $update_stmt = $db->prepare("UPDATE choose_a_teaching SET  subject_id=:subject_id,class_id=:class_id,status_choose='Active' WHERE choose_id = :id");
                    $update_stmt->bindParam(':subject_id', $code_up);
                    $update_stmt->bindParam(':class_id', $classroom_up);
                    $update_stmt->bindParam(':id', $id);

                    if($update_stmt->execute()){
                        $updateMeg = "Record update successfully...";
                        header("refresh:2,choose_a_teaching.php");
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
    <title>แก้ไขวิชาการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/bootstrap_button.css">
</head>
<body>
    <div class="container">
    <div class="display-3 text-center">แก้ไขวิชาการสอน</div>
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
            <label for="type" class="col-sm-3 control-label">ชื่อ</label>
            <div class="col-sm-6">
            <input type="text" name="txt_master_id" class="form-control" value="<?php echo $fname.' '.$lname; ?>" readonly>
            </div>
            </div>
        </div>

        <div class="form- text-center">
            <div class="row">
            <label for="type" class="col-sm-3 control-label">รหัสวิชา/วิชา</label>
            <div class="col-sm-6">
                <select name="txt_code" class="form-control">
                <option value="" selected="selected"><?php echo $code_subject.' '.$name_subject; ?></option>
                <?php foreach($result as $row){?>
                <option value="<?php echo $row["subject_id"]; ?>">
                <?php echo $row["code_subject"].' '.$row["name_subject"]; ?>
                </option>
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
                <option value="" selected="selected"><?php echo $name_classroom ?></option>
                <?php foreach($result1 as $row1){?>
                <option value="<?php echo $row1["class_id"]; ?>">
                <?php echo $row1["name_classroom"]; ?>
                </option>
                <?php } ?>
                </select>
            </div>
            </div>
        </div>
        
        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                        <a href="change_status_choose.php?change_id=<?php echo $row["choose_id"]; ?>" class="btn btn-info " onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">Change Status</a>
                    </div>
                </div>
        

        


            
            

        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="choose_a_teaching.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    
</body>
</html>