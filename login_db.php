<?php 
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    require_once 'connection.php';


    if (isset($_POST['btn_login'])) {
        $username = $_POST['txt_username']; // textbox name 
        $password = $_POST['txt_password']; // password
        $role = $_POST['txt_role']; // select option role
        $fname;
        $lname;
        $id;
    


        $status;
  
        if (empty($username)) {
            $errorMsg[] = "Please enter username";
        } else if (empty($password)) {
            $errorMsg[] = "Please enter password";
        } else if (empty($role)) {
            $errorMsg[] = "Please select role";
        } else if ($username AND $password AND $role) {
            try {
                $select_stmt = $db->prepare("SELECT username, password, user_role_id,status_master,fname,lname,master_id FROM login_information WHERE username = :uusername AND password = :upassword AND user_role_id = :urole");
                $select_stmt->bindParam(":uusername", $username);
                $select_stmt->bindParam(":upassword", $password);
                $select_stmt->bindParam(":urole", $role);
                //$select_stmt->bindParam(":ustatus'", $status);

                $select_stmt->execute(); 

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dbusername = $row['username'];
                    $dbpassword = $row['password'];
                    $dbrole = $row['user_role_id'];
                    $dbstatus = $row['status_master'];
                    $dbfname = $row['fname'];
                    $dblname = $row['lname'];
                    $dbid = $row['master_id'];

            
                    
                }
                if ($username != null AND $password != null AND $role != null ) {
                    if ($select_stmt->rowCount() > 0) {
                        if ($username == $dbusername AND $password == $dbpassword AND $role == $dbrole AND $dbstatus == 'Active' AND $fname = $dbfname AND $lname = $dblname AND $id = $dbid)  {
                            switch($dbrole) {
                                case '1':
                                    $_SESSION['login_type'] = 1;
                                    $_SESSION['user_login'] = $username;
                                    $_SESSION['success'] = "ยินดีต้อนรับผู้ดูแลระบบ";
                                    header("location: admin/admin_home.php");
                                break;
                                case '2':
                                    $_SESSION['login_type'] = 2;
                                    $_SESSION['user_login'] = $username;
                                    $_SESSION['success'] = "Director... Successfully Login...";
                                    header("location: director/director_home.php");
                                break;
                                case '3':
                                    $_SESSION['login_type'] = 3;
                                    $_SESSION['user_login'] = $username;
                                    $_SESSION['success'] = "Deputy Director... Successfully Login...";
                                    header("location: deputydirector/deputydirector_home.php");
                                break;
                                case '4':
                                    $_SESSION['login_type'] = 4;
                                    $_SESSION['user_login'] = $username;
                                    $_SESSION['success'] = "Academic Department... Successfully Login...";
                                    header("location: academicdepartment/academicdepartment_home.php");
                                break;
                                case '5':

                                    $_SESSION['login_type'] = 5;
                                    $_SESSION['user_login'] = $username;
                                    $_SESSION['fname'] = $fname;
                                    $_SESSION['lname'] = $lname;
                                    $_SESSION['master_id'] = $id;
                                    $_SESSION['success'] = "Teacher... Successfully Login...";
                                    header("location: teacher/teacher_home.php");
                                break;
                                default:
                                    $_SESSION['error'] = "กรุณาตรวจสอบบัญชีผู้ใช้ รหัสผ่าน หรือบทบาทใหม่อีกครั้ง";
                                    header("location: index.php");
                            }
                        }else{
                            $_SESSION['error'] = "กรุณาตรวจสอบบัญชีผู้ใช้ รหัสผ่าน หรือบทบาทใหม่อีกครั้ง";
                        header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = "กรุณาตรวจสอบบัญชีผู้ใช้ รหัสผ่าน หรือบทบาทใหม่อีกครั้ง";
                        header("location: index.php");
                    }
                }
            } catch(PDOException $e) {
                $e->getMessage();
            }
        }
    }

?>