<?php

    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if ($_SESSION['login_type'] != 1) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }


    require_once('../connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าที่ครู</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">หน้าที่ครู</div>
    <a href="add_choose_a_teaching.php" class="btn btn-success mb-3">เพิ่มหน้าที่ครู+</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>ห้องที่สอน</th>
                <th>สถานะ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select_stmt = $db->prepare("SELECT * FROM choose_a_teaching, subject ,classroom,login_information WHERE choose_a_teaching .subject_id = subject.subject_id AND choose_a_teaching .class_id = classroom.class_id AND choose_a_teaching .master_id = login_information.master_id ");
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
                        <td><a href="edit_choose.php?update_id=<?php echo $row['choose_id']; ?>" class="btn btn-warning">แก้ไข</td>
                        <td><a href="delete_choose.php?delete_id=<?php echo $row['choose_id']; ?>" class="btn btn-danger"class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบข้อมูล</td>
                    </tr>    
                <?php } ?>
        </tbody>
    </table>
    </div>
    </div>


    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
    </body>
</html>