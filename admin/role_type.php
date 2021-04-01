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
    <title>Role</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
    
    <div class="container">
    <div class="display-3 text-center">User Role</div>
    <a href="add_role.php" class="btn btn-success mb-3">Add+</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
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
                        <td><a href="edit_role.php?update_id=<?php echo $row['user_role_id']; ?>" class="btn btn-warning">Edit</td>
                        <td><a href="delete_role.php?delete_id=<?php echo $row['user_role_id']; ?>" class="btn btn-danger"class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">Delete</td>
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