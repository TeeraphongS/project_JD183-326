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
    <title>หน้าชั้นเรียน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">ชั้นเรียน</div>
            <a href="add_classroom.php" class="btn btn-success mb-3">เพิ่มชั้นเรียน</a>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ระดับชั้น</th>
                        <th>ชั้นเรียน</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                        <th>แก้ไขสถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                //$select_stmt = $db->prepare("SELECT  * FROM classroom as class, grade_level as grade WHERE class.grade_id = grade.grade_id");
                $select_stmt = $db->prepare("SELECT  * FROM classroom as class, grade_level as grade WHERE class.class_id = grade.id");
                // ^^ อันนี้คือพยายามจะทำอะไร ยังแก้บั๊กไม่หายนะ
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>

                    <tr>
                        <td><?php echo $row["name_gradelevel"];?></td>
                        <td><?php echo $row["name_classroom"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td><a href="edit_classroom.php?update_id=<?php echo $row['class_id']; ?>"
                                class="btn btn-warning">แก้ไข</td>
                        <td><a href="delete_classroom.php?delete_id=<?php echo $row['class_id']; ?>"
                                class="btn btn-danger" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบข้อมูล</td>
                        <td><a href="change_status_class.php?change_id=<?php echo $row["class_id"]; ?>"
                                class="btn btn-info "
                                onclick="return confirm('คุณต้องการเปลี่ยนสถานะของชั้นเรียนหรือไม่')">แก้ไขสถานะ</a>
                        </td>
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