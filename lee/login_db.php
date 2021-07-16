<?php 
session_start();
include("connect.php");
  
    $errors = array();

        if(isset($_POST['login_user'])){
                  $username = mysqli_real_escape_string($conn,$_POST['username']);
                  $password = mysqli_real_escape_string($conn,$_POST['password']);

            if(count($errors) == 0){
                $password = ($password);
                $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 1){
                 $_SESSION['username'] = $username;
                 header("location: home.php");
            }else{
                array_push($errors, "ชื่อ/รหัสผ่าน ไม่ถูกต้อง");
                $_SESSION['error'] = "ชื่อ/รหัสผ่าน ไม่ถูกต้อง";
                header("location: index.php");
              }
            }
        }
?>