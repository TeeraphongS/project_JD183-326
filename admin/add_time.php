<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }
    require_once('../connection.php');

    if(isset($_REQUEST['btn_insert'])){
        $time_name = $_REQUEST['txt_time_name'];
        $year = $_REQUEST['txt_year'];

        if(empty($time_name)){
            $errorMsg = "กรุณากรอก";
        }else {
            
                if(!isset($errorMsg)){
                    $sql ="INSERT INTO time(time_id,time_name,year_id)VALUES (NULL,'$time_name','$year')";
                    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
                    mysqli_close($conn);
    
                    if($result){
                    echo "<script>";
                    echo "alert('สำเร็จ');";
                    echo "window.location ='time.php'; ";
                    $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                    echo "</script>";
                    } else {
                    
                    echo "<script>";
                    echo "alert('ล้มเหลว!');";
                    echo "window.location ='time.php'; ";
                    echo "</script>";
                    }
                    /*$insert_stmt = $db->prepare("INSERT INTO login_information(fname,lname,username,password,email,user_role_id) VALUE(:fname,:lname,:user,:pass,:email,:role) ");
                    $insert_stmt->bindParam(":fname", $firstname);
                    $insert_stmt->bindParam(":lname", $lastname);
                    $insert_stmt->bindParam(":user", $username);
                    $insert_stmt->bindParam(":pass", $password);
                    $insert_stmt->bindParam(":email", $email);
                    $insert_stmt->bindParam(":role", $role);

                    if($insert_stmt->execute()){
                        $insertMsg = "เพิ่มข้อมูลของสมาชิกเสร็จสิ้น";
                        header("refresh:1,index.php");
                        
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
            */
                
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเวลาในการสอน</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<?php include_once('slidebar_admin.php'); ?>
    <div class="main">
    <div class="container">
    <div class="display-3 text-center">เพิ่มเวลาในการสอน</div>
    </div>
    <?php
        if(isset($errorMsg)){
    ?>
        <div class="alert alert-danger">
        <strong>เกิดข้อผิดพลาด! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>


    <?php
        if(isset($insertMsg)){
    ?>
        <div class="alert alert-success">
        <strong>ดำเนินการเสร็จสิ้น <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            <div class="form- text-center">
                <div class="row">
                <label for="firstname" class="col-sm-3 control-label">เวลาในการสอน</label>
                <div class="col-sm-6">
                    <input type="text" name="txt_time_name" class="form-control" placeholder="ตัวอย่าง 08:00-09:00">
                </div>
                </div>
            </div>
            <br>
            <div class="form- text-center">
                <div class="row">
                <label for="name_classroom" class="col-sm-3 control-label">ปีการศึกษา</label>
                <div class="col-sm-6">
                <select name="txt_year" class="form-control" required>
                    <?php
                $query1 = "SELECT * FROM year ";
                $result1 = mysqli_query($conn, $query1);
                    ?>
                <option value="">-ระบุปีการศึกษา-</option>
                    <?php foreach($result1 as $row1){
                        if( $row1["status_year"] == 'Active'){?>
                    
                    <option value="<?php echo $row1["year_id"];?>">
                    <?php echo $row1["term"].'/'.$row1["year_name"]; ?>
                    </option>
                    <?php } ?>
                    <?php } ?>
                </select>
                </div>
                </div>
            </div>
            <br>


            <div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-6">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
                    <a href="time.php." class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
    </form>
            </div>
    




    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

    </body>
</html>