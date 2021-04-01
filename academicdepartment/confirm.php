<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

if (!isset($_SESSION['academicdepartment_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
    header("location: ../index.php");
}

    require_once('../connection.php');

    if(isset($_REQUEST['confirm_id'])){
        try{
            $id = $_REQUEST['confirm_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_hours WHERE id_prepare = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            } catch(PDOException $e){
             $e->getMessage();
            }
    }

    $update_stmt = $db->prepare("UPDATE prepare_hours SET status_prepare_hours  = '2' WHERE id_prepare = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        $updateMeg = "Record update successfully...";
        header("refresh:2,check.php");
    }
?>