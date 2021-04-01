<?php

    require_once('connection.php');
    date_default_timezone_set('Asia/Bangkok');
    
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
<body>
    <!-- Sidebar -->
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
    <a href="add_hours.php" class="btn btn-success mb-3">เพิ่มเตรียมสอนรายชั่วโมง</a>
    <a href="importExcel.php" class="btn btn-success mb-3">A</a>
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
                $select_stmt = $db->prepare("SELECT  * FROM prepare_hours");
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>  
                        
                       <?php $row["date_prepare"]; ?>
                    <tr>
                        <td><?php echo date('Y-m-d ',strtotime($row["date_prepare"])) ?></td>
                        <td><a href="view_hours.php?view_id=<?php echo $row['id_prepare']; ?>" class="btn btn-info">View</td>
                        <td><a href="edit_hours.php?update_id=<?php echo $row["id_prepare"]; ?>" class="btn btn-warning">Edit</td>
                        <td><a href="download_hours.php?download_id=<?php echo $row["id_prepare"]; ?>" class="btn btn-success">Download</a></td>
                        <td><a href="delete_hours.php?delete_id=<?php echo $row['id_prepare']; ?>" class="btn btn-danger"class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">Delete</td>
                        <td><?php echo $row['status_prepare_hours']; ?></td>
                    </tr>    
                <?php } ?>
        </tbody>
    </table>
    </div>

    <a href="teacher_home.php"class="btn btn-warning">Back</a>
    <a href="../logout.php" class="btn btn-danger">Logout</a>
    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>