<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
    header("location: ../index.php");
}

    require_once('connection.php');

    if(isset($_REQUEST['delete_id'])){
        try{
            $id = $_REQUEST['delete_id'];
            $select_stmt = $db->prepare("SELECT * FROM subject_user WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            } catch(PDOException $e){
             $e->getMessage();
            }
    }

    $update_stmt = $db->prepare("UPDATE subject_user SET status  = 'Inactive' WHERE id = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        $updateMeg = "Record update successfully...";
        header("refresh:2,subject.php");
    }
?>