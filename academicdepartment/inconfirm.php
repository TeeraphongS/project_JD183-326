<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

if ($_SESSION['login_type'] != 4) {//คำสั่งต้องloginก่อนถึงเข้าได้
    header("location: ../index.php");
}

    require_once('../connection.php');

    if(isset($_REQUEST['inconfirm_id'])){
        try{
            $id = $_REQUEST['inconfirm_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_to_teach WHERE id_prepare = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            } catch(PDOException $e){
             $e->getMessage();
            }
    }

    $update_stmt = $db->prepare("UPDATE prepare_to_teach SET status_prepare_hours  = 'Incomplete' WHERE id_prepare = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        $updateMeg = "Record update successfully...";
        header("refresh:2,check.php");
    }
?>