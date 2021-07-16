
<?php
    session_start();
    if (!isset($_SESSION['user_login'])){
      header("location: ../index.php");
    }
    date_default_timezone_set('Asia/Bangkok');
    include("../connection.php");
    //กำหนดเวลาที่สามารถอยู่ในระบบ
    /*$sessionlifetime = 600; //กำหนดเป็นนาที
    
    if(isset($_SESSION["timeLasetdActive"])){
      $seclogin = (time()-$_SESSION["timeLasetdActive"])/60;
      //หากไม่ได้ Active ในเวลาที่กำหนด
      if($seclogin>$sessionlifetime){
        session_destroy();
      }else{
        $_SESSION["timeLasetdActive"] = time();
      }
    }else{
      $_SESSION["timeLasetdActive"] = time();
    }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="" content="1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>ระบบลงชื่อเข้า/ออก</title>

    <link rel="stylesheet" href="style.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script language="javascript">
    $(document).ready(function()
    {
      setInterval(function(){
       var dd=new Date();
      $("#autodate").text(+ dd.getDate() + "-" + (dd.getMonth()+1) + "-" + (dd.getFullYear()+543));

      var dt=new Date();
      $("#autotime").text(+ dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds());
      },1000); 
    })
  </script>
<body>
  <form action="submit_db.php" method="post">
    <br>
    <div class="container">
      <div class="row">
        <div class="col col-sm-12">
          <h3  class="jumbotron" align="center"> ระบบลงชื่อเข้า - ลงชื่อออก เวลาการทำงาน </h3>
        </div>
      </div>
    </div>
        <?php $query = "SELECT * FROM login_information WHERE username = '".$_SESSION['user_login']."'";
              $result = mysqli_query($conn, $query) or die ("Error in sql: $query" . mysqli_error($query));
        ?>
        <?php while ($row = mysqli_fetch_array($result)){//if (isset($_SESSION['username'])) : ?>
                <h3 align="center">สวัสดีคุณ : <?php echo $row['fname']; ?> &nbsp;  <?php echo $row['lname']; ?></h3>   
        <?php }?><?php?><br>
                <h5 align="center">
        <?php $today = date('Y-m-d'); 
              $sql1 = "SELECT * FROM work WHERE work_date = '$today' AND username = '".$_SESSION['username']."' ";
              $result1 = mysqli_query($conn, $sql1) or die ("Error in sql: $sql1" . mysqli_error($sql1));              
        ?>            
        <?php $num = mysqli_fetch_array($result1);$num2 = mysqli_num_rows($result1)?>
        <?php if($num2 != 0){?>
            <p align="center" >เวลาเข้า : <?php  echo  $num['work_in'];?></p> 
            <?php if($num['work_out'] == '00:00:00'){?>
                <p align="center" >เวลาออก : <?php  ?></p> 
            <?php }else{?> 
                <p align="center" >เวลาออก : <?php  echo  $num['work_out'];?></p>
            <?php }
            }else{?>
                <p align="center" >เวลาเข้า : <?php  ?></p>              
                <p align="center" >เวลาออก : <?php  ?></p> 
            <?php }?>
                </h5>
        <div class="day">
          <h1 >วัน/เดือน/ปี</h1>
        <br></div>
          <h1><div id="autodate" align="center"></div></h1>
        <br>
        <div class="time">
            <h1 align="center">เวลา</h1>
        </div>
        <br>

        <h1><div id="autotime" align="center"></div></h1>
        <br><?php
                    if ((!isset($num['work_date'])) && (!isset($num['work_in'])) && (!isset($num['work_out']))) {?>
              <center>
                  <button type="submit" name="work_in"  class="btn" id="btnGetLocation">ลงชื่อเข้า</button> <br><br> <button type="submit" name="work_wfh"  class="btn" id="btnGetLocation">ลงชื่อ Work from home</button>
              </center>
                  <?php }else if((isset($num['work_date'])) && (isset($num['work_in'])) && (($num['wfh'] == '1')) && (($num['work_out'] == '00:00:00'))){?>
              <center>
                  <button  style="background-color:blue;" type="submit"  name="wfh_out" class="btn1">ลงชื่อออก</button>
              </center>
                  <?php }else if((isset($num['work_date'])) && (isset($num['work_in'])) && (($num['work_out'] == '00:00:00'))){?>
              <center>
                  <button  style="background-color:blue;" type="submit"  name="work_out" class="btn1">ลงชื่อออก</button>
              </center>
                  <?php }else if((isset($num['work_date'])) && (isset($num['work_in'])) && (isset($num['work_out']))){?><br>
              <center>
                  <button  style="background-color:red;"  type="submit" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่ ?')"  name="log_out" class="btn">ออกจากระบบ</button>
              </center>
              <?php } 
               ?>
              <?php mysqli_close($conn);?>
  </form>

</body>
</html>