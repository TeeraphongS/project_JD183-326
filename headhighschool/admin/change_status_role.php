<?php

session_start();//คำสั่งต้องloginก่อนถึงเข้าได้


    require_once('../connection.php');

    if(isset($_REQUEST['change_id'])){
        $id = $_REQUEST['change_id'];

        $sql = "SELECT * FROM  user_role WHERE user_role_id = '".$id."'";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
        $row = mysqli_fetch_array($result);
        extract($row);
    }

    $sql = "UPDATE user_role SET  status_role  = 'Active' WHERE user_role_id = '".$id."'";
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
    mysqli_close($conn); //ปิดการเชื่อมต่อ database 

    if($result){
    echo "<script type='text/javascript'>";
    echo "alert('อัพเดตข้อมูลสถานะเสร็จสิ้น');";
    echo "window.location = 'role_type.php'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาดกรุณาอัพเดตใหม่อีกครั้ง');";
    echo "</script>";
    }
    
    
?>