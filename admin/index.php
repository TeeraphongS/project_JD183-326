<?php
    session_start();

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../index.php");
    }
    require_once('connection.php');

    if(isset($_REQUEST['delete_id'])){
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM masterlogin WHERE id= :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        //Delate an oridinal record form db
        $delete_stmt = $db->prepare("DELETE FROM masterlogin WHERE id = :id");
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
    <div class="container">
    <div class="display-3 text-center">Information</div>
    <a href="add.php" class="btn btn-success mb-3">Add+</a>
    <table class="table table-striped table-bordered tablr-hover">
        <thead>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php
                $select_stmt = $db->prepare("SELECT * FROM masterlogin ,user_role  WHERE masterlogin.user_role_id=user_role.user_role_id"); 
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
                    <td><a href="edit.php?update_id=<?php echo $row["master_id"]; ?>" class="btn btn-warning">Edit</td>
                    <td><a href="delete.php?delete_id=<?php echo $row["master_id"]; ?>" class="btn btn-danger " onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">Delete</td>
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