<?php
    session_start();

    if ($_SESSION['login_type'] != 1) {
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['delete_id'])){
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM login_information WHERE id= :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        //Delate an oridinal record form db
        $delete_stmt = $db->prepare("DELETE FROM login_information WHERE id = :id");
        $delete_stmt->bindParam(':id',$id);
        $delete_stmt->execute();

        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">ข้อมูลบัญชีผู้ใช้</div>
            <a href="add.php" class="btn btn-success mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg> เพิ่มบุคลากร</a>
            <table class="table table-striped table-bordered tablr-hover">
                <thead>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ชื่อบัญชีผู้ใช้</th>
                    <th>รหัสผ่าน</th>
                    <th>อีเมลล์</th>
                    <th>บทบาท</th>
                    <th>สถานะ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                    <th>แก้ไขสถานะ</th>
                </thead>
                <tbody>
                    <?php
                $select_stmt = $db->prepare("SELECT * FROM login_information ,user_role WHERE login_information.user_role_id=user_role.user_role_id ORDER BY master_id DESC"); 
                $select_stmt->execute();

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
                    <tr>
                        <td><?php echo $row["fname"]; ?></td>
                        <td><?php echo $row["lname"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["password"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["name_role"]; ?></td>
                        <td><?php echo $row["status_master"]; ?></td>
                        <td><a href="edit.php?update_id=<?php echo $row["master_id"]; ?>" class="btn btn-warning">แก้ไข
                        </td>
                        <td><a href="delete.php?delete_id=<?php echo $row["master_id"]; ?>" class="btn btn-danger "
                                onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบข้อมูล</td>
                        <td><a href="change_status.php?change_id=<?php echo $row["master_id"]; ?>" class="btn btn-info "
                                onclick="return confirm('คุณต้องการเปลี่ยนสถานะของผู้ใช้หรือไม่')">แก้ไขสถานะ</a></td>
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