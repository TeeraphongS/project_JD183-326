<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้


    

    require_once('../connection.php');

    if(isset($_REQUEST['view_id'])){
        try{
            $id = $_REQUEST['view_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_to_teach as pre, subject as sub, classroom as class  WHERE pre.id_prepare = :id AND pre.subject_id = sub.subject_id AND pre.class_id = class.class_id  ");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Page Hours</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>
    <?php include_once('slidebar_teacher.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">View Page</div>
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
                        <input type="text" name="" class="form-control"
                            value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>" readonly />
                    </div>
                </div>
            </div>





            <div class="form- text-center">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วิชา</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_name_role" class="form-control"
                            value="<?php echo $row['name_subject']; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชั้น</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_name_role" class="form-control"
                            value="<?php echo $row['name_classroom']; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วันที่</label>
                    <div class="col-sm-6">
                        <input type="text" name="txt_name_role" class="form-control"
                            value="<?php echo $row['date_prepare']; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สาระการเรียนรู้/ตัวชี้วัด</label>
                    <div class="col-sm-6">
                        <textarea rows="10" cols="55" name="description" class="form-control" required
                            readonly /><?php echo $row['learning']; ?> </textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">จุดประสงค์</label>
                    <div class="col-sm-6">
                        <textarea rows="10" cols="55" name="description" class="form-control" required
                            readonly /><?php echo $purpose; ?> </textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-center">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สอนอย่างไร(กระบวนการจัดการเรียน)</label>
                    <div class="col-sm-6">
                        <textarea rows="10" cols="55" name="description" class="form-control" required
                            readonly /><?php echo $how_to_teach; ?> </textarea>
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






        </form>

        <form method="post" class="form-horizontal mt-5">

            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
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