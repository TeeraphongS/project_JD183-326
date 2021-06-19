<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    

    require_once('../connection.php');
    $id1 = $_SESSION['master_id'];
    //$query2 = "SELECT * FROM subject_user as s,choose_a_teaching as c,classroom_user as class, prepare_hours as pre WHERE c.master_id= ".$id." AND c.subject_id = s.subject_id AND c.class_id = class.class_id AND pre.subject_id = s.subject_id";//เชื่อม2ตาราง
    //$result2 = mysqli_query($conn,$query2); 

    if(isset($_REQUEST['update_id'])){
        try{
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_to_teach as pre , subject as sub , classroom as class WHERE pre.id_prepare = :id AND pre.subject_id = sub.subject_id AND pre.class_id = class.class_id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }if(isset($_REQUEST['btn_update'])){//ตั้งตัวแปร up 
        $subject_up =$_REQUEST['txt_subject_id'];
        $classroom_up =$_REQUEST['txt_class']; 
        $learn_up =$_REQUEST['txt_learn'];
        $purpose_up =$_REQUEST['txt_pur'];
        $how_to_teach_up =$_REQUEST['txt_how'];
        $media_up =$_REQUEST['txt_media']; 
        $measure_up =$_REQUEST['txt_measure'];
       // echo 'update ='.$id = $_REQUEST['update_id'] .'<br>';
        $date_prepare = $_REQUEST['txt_date'];
        $status = "Checking";
        
        

        if(empty($subject_up)){
            $errorMsg = "Please enter Subject";
        }elseif(empty($classroom_up)){
            $errorMsg = "Please enter learn";
        }else if(empty($learn_up)){
                $errorMsg = "Please enter learn";
        }else if(empty($purpose_up)){
            $errorMsg = "Please enter purpose";
        }else if(empty($how_to_teach_up)){
            $errorMsg = "Please enter how_to_teach";
        }else if(empty($media_up)){
            $errorMsg = "Please enter media";
        }else if(empty($measure_up)){
            $errorMsg = "Please enter measure";
        }else{
            try{
                if(!isset($errorMsg)){echo 'bf';
                    $update_stmt = $db->prepare("UPDATE prepare_to_teach 
                   SET  subject_id='".$subject_up."', class_id='".$classroom_up."', date_prepare ='".$date_prepare."'
                   , learning='".$learn_up."',purpose='".$purpose_up."',how_to_teach='".$how_to_teach_up."',media='".$media_up."',measure='".$measure_up."',status_prepare_hours='".$status."' 
                   WHERE id_prepare = '".$id."'");
                }

                    if($update_stmt->execute()){
                        $updateMeg = "Record update successfully...";
                        header("refresh:2,hours.php");
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
    <title>Edit Role</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_teacher.php'); ?>
    <div class="main">
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
                <label for="name_role" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_name_up" class="form-control" value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?>"readonly/>
                </div>
                </div>
            </div>


        

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน</label>
                <div class="col-sm-6">
                    <select name="txt_subject_id" class="form-control">
                    <?php //foreach($result2 as $row2){?>
                    <?php $query = ("SELECT * FROM choose_a_teaching as c, subject as sub WHERE c.master_id = ".$id1. " AND c.subject_id = sub.subject_id");
                        $result2 =mysqli_query($conn,$query);
                        
                     ?>
                    
                    <?php foreach($result2 as $row2){
                        if($row["subject_id"] == $row2["subject_id"]){?>
                            <option value="<?php echo $row2["subject_id"]; ?>" selected="selected"><?php echo $row2['name_subject']; ?></option>
                    <?php }
                        else{?>
                            <option value="<?php echo $row2["subject_id"]; ?>"><?php echo $row2['name_subject']; ?></option><?php
                        }
                    } ?>
                    </select>
                </div>
                </div>
            </div>
            

        

            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">ห้องที่สอน</label>
                <div class="col-sm-6">
                    <select name="txt_class" class="form-control">
                    <?php $query2 = ("SELECT * FROM choose_a_teaching as c, classroom as class WHERE c.master_id = ".$id1. " AND c.class_id = class.class_id");
                    $result3 =mysqli_query($conn,$query2);
                     ?>
                    <?php foreach($result3 as $row3){
                        if($row["class_id"] == $row3["class_id"]){?>
                            <option value="<?php echo $row3["class_id"]; ?>" selected="selected"><?php echo $row3['name_classroom']; ?></option>
                    <?php 
                    }else { ?>
                        <option value="<?php echo $row3["class_id"]; ?>"><?php echo $row3['name_classroom']; ?></option> 
                    <?php } ?>
                    
                    </option>
                    <?php } ?>
                    </select>
                </div>
                </div>
            </div>
            
            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">วันที่</label>
                <div class="col-sm-6">
                <input type="date" name="txt_date" class="form-control" value="<?php echo $row['date_prepare'] ?>">
                </div>
                </div>
            </div>


            

            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">Learning</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="description" class="form-control" required>
                <?php echo $row['learning']; ?> </textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">Purpose</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="description" class="form-control" required>
                <?php echo $purpose; ?> </textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">สอนอย่างไร</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="description" class="form-control" required>
                <?php echo $how_to_teach; ?> </textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">สื่อ/อุปกรณ์การเรียนรู้</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="description" class="form-control"
                            required><?php echo $media; ?> </textarea>
                </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                <label for="name_role" class="col-sm-3 control-label">วิธีวัดและประเมินการสอน/เครื่องมือ</label>
                <div class="col-sm-6">
                <textarea rows="10" cols="55" name="description" class="form-control"
                            required><?php echo $measure; ?> </textarea>
                </div>
                </div>
            </div>

            

            <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="hours.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>

    </form>
</div>
    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>