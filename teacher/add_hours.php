<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    date_default_timezone_set('Asia/Bangkok');

    require_once('connection.php');

    $id = $_SESSION['master_id'];
    $query2 = "SELECT * FROM subject_user as s,choose_a_teaching as c,classroom_user as class 
    WHERE c.master_id= ".$id." AND c.subject_id = s.subject_id AND c.class_id = class.class_id";//เชื่อม2ตาราง
    $result2 = mysqli_query($conn,$query2); 
    
    if(isset($_REQUEST['btn_insert'])){ 
        
        $name = $_REQUEST['txt_name'];
        $subject = $_REQUEST['txt_subject_id'];
        $learn = $_REQUEST['txt_learn'];
        $purpose = $_REQUEST['txt_purpose'];
        $how_to_teach = $_REQUEST['txt_how_to_teach'];
        $media = $_REQUEST['txt_media'];
        $measure = $_REQUEST['txt_measure'];
        $date_prepare = $_REQUEST['txt_date'];
        $class = $_REQUEST['txt_class_id'];
        
    }

        if(empty($subject)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของรายวิชา";
        }elseif(empty($class)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของห้องเรียน";
        }elseif(empty($date_prepare)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของวัน";
        }elseif(empty($learn)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของสาระการเรียนรู้/ตัวชี้วัด";
        }else if(empty($purpose)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของจุดประสงค์";
        }else if(empty($how_to_teach)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของสอนอย่างไร(กระบวนการจัดการเรียน)";
        }else if(empty($media)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของสื่อ/อุปกรณ์การเรียนรู้";
        }else if(empty($measure)){
            $errorMsg = "กรุณาเพิ่มข้อมูลในช่องของวิธีวัดและประเมินการสอน/เครื่องมือ";
        }else {
            try{
                if(!isset($errorMsg)){
                    $insert_stmt = $db->prepare("INSERT INTO prepare_hours
                    (master_id,subject_id,class_id,date_prepare,learning,purpose,how_to_teach,media,measure) 
                    VALUE(:master_id,:subject_id,:class_id,:date_prepare,:learning,:purpose,:how_to_teach,:media,:measure)");
                    $insert_stmt->bindParam(":master_id", $id);
                    $insert_stmt->bindParam(":date_prepare",$date_prepare);
                    $insert_stmt->bindParam(":learning", $learn);
                    $insert_stmt->bindParam(":purpose",$purpose);
                    $insert_stmt->bindParam(":how_to_teach", $how_to_teach);
                    $insert_stmt->bindParam(":media", $media);
                    $insert_stmt->bindParam(":measure",$measure);
                    $insert_stmt->bindParam(":subject_id",$subject);
                    $insert_stmt->bindParam(":class_id",$class);
                    


                    if($insert_stmt->execute()){ 
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2,hours.php");
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }

    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเตรียมสอนรายชั่วโมง</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div class="w3-sidebar w3-black w3-bar-block" style="width:20%">
  <a href="teacher_home.php"><h3 class="w3-bar-item">Home</h3></a>
  <a href="hours.php" class="w3-bar-item w3-button">กรอกเตรียมสอนรายชั่วโมง</a>
  <a href="week.php" class="w3-bar-item w3-button">กรอกจุดประสงค์รายสัปดาห์</a>
  <a href="../logout.php" class="w3-bar-item w3-button">Logout</a>
</div>
<div style="margin-left:20%">

<div class="w3-container w3-teal">
</div>
    <div class="w3-container">
    <div class="display-3 text-center">เตรียมสอนรายชั่วโมง</div>
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
                <label for="fname" class="col-sm-3 control-label">ชื่อ-สกุล</label>
                <div class="col-sm-6">
                    <input type="text" name=" txt_name" class="form-control" value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>">
                </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">วิชาที่สอน</label>
                <div class="col-sm-6">
                    <select name="txt_subject_id" class="form-control">
                    <option value="" selected="selected">- กรุณาเลือก -</option>
                    <?php foreach($result2 as $row2){?>
                
                    <option value="<?php echo $row2["subject_id"] ?>">
                    <?php
                            echo $row2['name_subject'];
                        ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
                </div>
            </div>
            <br>


            <div class="form- text-center">
                <div class="row">
                <label for="name_subject" class="col-sm-3 control-label">ระดับชั้นที่สอน/วันที่</label>
                <div class="col-sm-6">
                    <select name="txt_class_id" class="form-control">
                    <option value="" selected="selected">- กรุณาเลือก -</option>
                    <?php foreach($result2 as $row2){?>
                    <?php ($row3 = $result3 ); ?>
                
                    <option value="<?php echo $row2["class_id"] ?>">
                    <?php
                            echo $row2['name_classroom'];
                        ?>
                    </option>
                    <?php } ?>
                    </select>
                    <input type="date" name="txt_date" class="form-control">
                </div>
                </div>
            </div>
            <br>
            
            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">สาระการเรียนรู้/ตัวชี้วัด</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_learn" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">จุดประสงค์</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_purpose" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">สอนอย่างไร(กระบวนการจัดการเรียน)</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_how_to_teach" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            
            <br>
            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">สื่อ/อุปกรณ์การเรียนรู้</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_media" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>
            <br>

            <div class="form- text-center">
                <div class="row">
                <label for="" class="col-sm-3 control-label">วิธีวัดและประเมินการสอน/เครื่องมือ</label>
                <div class="col-sm-6">
                <textarea id="" name="txt_measure" rows="4" cols="95">
                </textarea>
                </div>
                </div>
            </div>

           

        


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="hours.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
    </form>

    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>