<?php

    require_once('../connection.php');
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
    <?php include('slide_bar.php'); ?>
    <div class="w3-container">
    <div class="display-3 text-center">ตรวจสอบเตรียมสอนรายชั่วโมง</div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>View</th>
                <th>Download</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select_stmt = $db->prepare("SELECT  * FROM prepare_hours");
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>  
                        
                       
                    <tr>
                    <?php if($row['status_prepare_hours']=='2'){
                     ?> <td><?php echo date('Y-m-d ',strtotime($row["date_prepare"])) ?></td>
                        <td><a href="view_hours.php?view_id=<?php echo $row['id_prepare']; ?>" class="btn btn-primary">View</td>
                        <td><a href="download_hours.php?download_id=<?php echo $row["id_prepare"]; ?>" class="btn btn-dark">Download</a></td>
                        <td><?php echo $row['status_prepare_hours']; ?></td>
                    <?php } ?>
                    </tr>    
                <?php } ?>
        </tbody>
    </table>
    </div>

    
    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>