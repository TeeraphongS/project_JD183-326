<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้


    require_once('../connection.php');

    if(isset($_REQUEST['change_id'])){
        try{
            $id = $_REQUEST['change_id'];
            $select_stmt = $db->prepare("SELECT * FROM login_information WHERE master_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            } catch(PDOException $e){
             $e->getMessage();
            }
    }

    $update_stmt = $db->prepare("UPDATE login_information SET status_master='Active' WHERE master_id = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        $updateMeg = "Record update successfully...";
        header("refresh:1,index.php?update_id=$id");
    }
    
    
?>