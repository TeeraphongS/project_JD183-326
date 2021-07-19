<?php 
    /*session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

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
            $errorMsg[] = "กรุณากรอกชื่อบัญชีผู้ใช้";
        } else if (empty($password)) {
            $errorMsg[] = "กรุณากรอกรหัสผ่าน";
        } else if (empty($role)) {
            $errorMsg[] = "กรุณาระบุบทบาท";
        } else if ($username AND $password AND $role) {
           
                
                $strSQL = "SELECT username, password, user_role_id,status_master,fname,lname,master_id FROM login_information WHERE username = '".$username."' 
	            AND password = '".$password." 'AND user_role_id = '".$role."' ";
                $objQuery = mysqli_query($strSQL);
                $objResult = mysqli_fetch_array($objQuery);


                while($row =    $objResult) {
                    $dbusername = $row['username'];
                    $dbpassword = $row['password'];
                    $dbrole = $row['user_role_id'];
                    $dbstatus = $row['status_master'];
                    $dbfname = $row['fname'];
                    $dblname = $row['lname'];
                    $dbid = $row['master_id'];
                }
            
                    
                
                if ($username != null AND $password != null AND $role != null ) {
                        if ($username == $dbusername AND $password == $dbpassword AND $role == $dbrole AND $dbstatus == 'Active')  {
                            switch($dbrole) {
                                case '1':
                                    $_SESSION['admin_login'] = $username;
                                    $_SESSION['success'] = "ผู้ดูแลระบบ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: admin/admin_home.php");
                                break;
                                case '2':
                                    $_SESSION['director_login'] = $username;
                                    $_SESSION['success'] = "ผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: director/director_home.php");
                                break;
                                case '3':
                                    $_SESSION['deputydirector_login'] = $username;
                                    $_SESSION['success'] = "รองผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: deputydirector/deputydirector_home.php");
                                break;
                                case '4':
                                    $_SESSION['academicdepartment_login'] = $username;
                                    $_SESSION['success'] = "ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: academicdepartment/academicdepartment_home.php");
                                break;
                                case '5':
                                    
                                    $_SESSION['teacher_login'] = $username;
                                    $_SESSION['fname'] = $fname;
                                    $_SESSION['lname'] = $lname;
                                    $_SESSION['master_id'] = $id;
                                    $_SESSION['success'] = "ครู ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                                    header("location: teacher/teacher_home.php");
                                break;
                                default:
                                    $_SESSION['error'] = "กรุณาตรวจสอบบัญชีผู้ใช้ รหัสผ่าน หรือบทบาทใหม่อีกครั้ง";
                                    header("location: index.php");
                            }
                        }else{
                            
                               // $_SESSION['admin_login'] = $username;
                               // $_SESSION['success'] = "ผู้ดูแลระบบ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                               // header("location: admin/admin_home.php");
                            
                            //$_SESSION['error'] = "กรุณาตรวจสอบบัญชีผู้ใช้ รหัสผ่าน หรือบทบาทใหม่อีกครั้ง";
                        //header("location: index.php");
                        }
                    
                }
            
        
    }
    }*/
?>
<?php 
session_start();
        if(isset($_POST['btn_login'])){
				//connection
                  include("connection.php");
				//รับค่า user & password
                  $username = $_POST['txt_username'];
                  $password = $_POST['txt_password'];
                  $role = $_POST['txt_role'];
				//query 
                  $sql="SELECT * FROM login_information Where username='".$username."' and password='".$password."' and user_role_id ='".$role."' ";

                  $result = mysqli_query($conn,$sql);
				
                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["UserID"] = $row["master_id"];
                      $_SESSION["User"] = $row["fname"]." ".$row["lname"];
                      $_SESSION["Userlevel"] = $row["user_role_id"];
                      

                      if($_SESSION["Userlevel"]== "1" && $row['status_master'] == 'Active'  ){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                        $_SESSION['admin_login'] = $username;
                        $_SESSION['success'] = "ผู้ดูแลระบบ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: admin/admin_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="2" && $row['status_master'] == 'Active' ){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['director_login'] = $username;
                        $_SESSION['success'] = "ผู้อำนวยการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: director/director_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="3" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['deputydirector_login'] = $username;
                        $_SESSION['success'] = "รองผู้อำนวยการ ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: deputydirector/deputydirector_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="4" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['academicdepartment_login'] = $username;
                        $_SESSION['success'] = "ฝ่ายวิชาการ ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: academicdepartment/academicdepartment_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }
                      

                      if ($_SESSION["Userlevel"]=="5" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['teacher_login'] = $username;
                        $_SESSION["User"];
                        $_SESSION['master_id'] = $id;
                        $_SESSION['success'] = "ครู ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: teacher/teacher_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                      if ($_SESSION["Userlevel"]=="6" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['headprimary_login'] = $username;
                        $_SESSION['success'] = "หัวหน้าช่วงชั้นประถม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: headprimary/headprimary_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }
                      if ($_SESSION["Userlevel"]=="7" && $row['status_master'] == 'Active'){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        $_SESSION['headhighschool_login'] = $username;
                        $_SESSION['success'] = "หัวหน้าช่วงชั้นมัธยม ... ดำเนินการเข้าสู่ระบบเสร็จสิ้น";
                        header("location: headhighschool/headhighschool_home.php");

                      }else{
                        echo "<script>";
                            echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
    
                      }

                  }else{
                    echo "<script>";
                        echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
                  }

                }else{
                  echo "<script>";
                      echo "alert(\" ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง\");"; 
                      echo "window.history.back()";
                  echo "</script>";
                }
?>

    