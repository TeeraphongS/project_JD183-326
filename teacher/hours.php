<?php

    require_once('../connection.php');
    date_default_timezone_set('Asia/Bangkok');
    if(isset($_REQUEST['delete_id'])){
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM prepare_to_teach WHERE id_prepare=:id");
        $select_stmt ->bindParam(':id',$id);
        $select_stmt ->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        //Delete
        $delete_stmt = $db->prepare("DELETE FROM prepare_to_teach WHERE id_prepare=:id");
        $delete_stmt ->bindParam(':id',$id);
        $delete_stmt->execute();

        header('Location:hours.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เตรียมสอนรายชั่วโมง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<?php include_once('slidebar_teacher.php'); ?>
<div class="main">
    <div class="container">
        <div class="display-3 text-center">เตรียมสอนรายชั่วโมง</div>
        <a href="add_hours.php" class="btn btn-success mb-3">เพิ่มเตรียมสอนรายชั่วโมง</a>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Download</th>
                    <th>Delete</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_stmt = $db->prepare("SELECT  * FROM prepare_to_teach");
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>

                <?php $row["date_prepare"]; 
                ?>
                <tr>
                    <?php if($row['status_prepare_hours']!='Complete'){?>
                    <td><?php echo date("d/m/Y ",strtotime($row["date_prepare"])) ?></td>
                    <td><a href="view_hours.php?view_id=<?php echo $row['id_prepare']; ?>" class="btn btn-info">View
                    </td>
                    <td><a href="edit_hours.php?update_id=<?php echo $row["id_prepare"]; ?>"
                            class="btn btn-warning">Edit</td>
                    <td><a target ="_blank" href="download_hours.php?download_id=<?php echo $row["id_prepare"]; ?>"
                            class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg> Download</a></td>
                    <td><a href="?delete_id=<?php echo $row['id_prepare']; ?>" class="btn btn-danger"
                            onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">Delete</td>
                    <td><?php if($row['status_prepare_hours'] == 'Checking'){
                        echo 'รอการตรวจสอบการส่ง';
                    }elseif($row['status_prepare_hours'] == 'Incomplete'){
                        echo 'ไม่ผ่านต้องแก้ไข';
                    } ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<script src="js/slime.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>