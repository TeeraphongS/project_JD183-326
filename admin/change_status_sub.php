<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้


    require_once('../connection.php');

    if(isset($_REQUEST['change_id'])){
        try{
            $id = $_REQUEST['change_id'];
            $select_stmt = $db->prepare("SELECT * FROM subject WHERE subject_id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            } catch(PDOException $e){
             $e->getMessage();
            }
    }

    $update_stmt = $db->prepare("UPDATE subject SET status='Active' WHERE subject_id = :id");
    $update_stmt->bindParam(':id', $id);
    if($update_stmt->execute()){
        header("refresh:1,subject.php?update_id=$id");
    }
    
    
?>