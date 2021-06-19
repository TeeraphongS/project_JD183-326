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
    <title>บทบาท</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">บทบาทผู้ใช้</div>

            <a href="add_role.php">
                <button type="button" class="btn btn-success mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                        </path>
                    </svg>
                    เพิ่มบทบาท
                </button>
            </a>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ชื่อบทบาท</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                        <th>แก้ไขสถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $select_stmt = $db->prepare("SELECT  * FROM user_role");
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                ?>

                    <tr>
                        <td><?php echo $row["name_role"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td><a href="edit_role.php?update_id=<?php echo $row['user_role_id']; ?>"
                                class="btn btn-warning">แก้ไข</td>
                        <td><a href="delete_role.php?delete_id=<?php echo $row['user_role_id']; ?>"
                                class="btn btn-danger" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบข้อมูล</td>
                        <td><a href="change_status_role.php?change_id=<?php echo $row["user_role_id"]; ?>" class="btn btn-info "
                                onclick="return confirm('คุณต้องการเปลี่ยนสถานะของบทบาทหรือไม่')">แก้ไขสถานะ</a></td>
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