<?php

    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }


    require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose a teaching Page</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    
    <div class="container">
    <div class="display-3 text-center">Choose a teaching</div>
    <a href="add_choose_a_teaching.php" class="btn btn-success mb-3">Add+</a>
    <a href="importExcel.php" class="btn btn-success mb-3">Add Excel</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>ห้องที่สอน</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select_stmt = $db->prepare("SELECT * FROM choose_a_teaching, subject_user ,classroom_user,masterlogin WHERE choose_a_teaching .subject_id = subject_user.subject_id AND choose_a_teaching .class_id = classroom_user.class_id AND choose_a_teaching .master_id = masterlogin.master_id ");
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>  

                    <tr>
                        <td><?php echo $row["fname"]; ?></td>
                        <td><?php echo $row["lname"]; ?></td>
                        <td><?php echo $row["code_subject"]; ?></td>
                        <td><?php echo $row["name_subject"]; ?></td>
                        <td><?php echo $row["name_classroom"]; ?></td>
                        <td><?php echo $row["status_choose"]; ?></td>
                        <td><a href="edit_choose.php?update_id=<?php echo $row['choose_id']; ?>" class="btn btn-warning">Edit</td>
                        <td><a href="delete_choose.php?delete_id=<?php echo $row['choose_id']; ?>" class="btn btn-danger"class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">Delete</td>
                    </tr>    
                <?php } ?>
        </tbody>
    </table>
    </div>

    <a href="admin_home.php"class="btn btn-warning">Back</a>
    <a href="../logout.php" class="btn btn-danger">Logout</a>
    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>