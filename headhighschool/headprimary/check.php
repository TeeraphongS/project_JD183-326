<?php
session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

if (!isset($_SESSION['headprimary_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
    header("location: ../index.php");
}
  
require_once('../connection.php');
date_default_timezone_set('Asia/Bangkok');

$query=mysqli_query($conn,"SELECT COUNT(id_prepare) FROM prepare_to_teach");
$row = mysqli_fetch_row($query);

$rows = $row[0];

$page_rows = 10;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

$last = ceil($rows/$page_rows);

if($last < 1){
    $last = 1;
}

$pagenum = 1;

if(isset($_GET['pn'])){
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}

if ($pagenum < 1) {
    $pagenum = 1;
}
else if ($pagenum > $last) {
    $pagenum = $last;
}

$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

$nquery=mysqli_query($conn,"SELECT * from  prepare_to_teach as pre,choose_a_teaching as c,subject as sub,classroom as class,grade_level as grade,login_information as login
WHERE pre.choose_id = c.choose_id AND c.class_id = class.class_id AND c.subject_id = sub.subject_id AND c.grade_id = grade.grade_id AND c.master_id = login.master_id
ORDER BY id_prepare DESC $limit");

$paginationCtrls = '';

if($last != 1){

    if ($pagenum > 1) {
$previous = $pagenum - 1;
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info">ย้อนกลับ</a> &nbsp; &nbsp; ';

        for($i = $pagenum-4; $i < $pagenum; $i++){
            if($i > 0){
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
            }
    }
}

    $paginationCtrls .= ''.$pagenum.' &nbsp; ';

    for($i = $pagenum+1; $i <= $last; $i++){
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
        if($i >= $pagenum+4){
            break;
        }
    }

if ($pagenum != $last) {
$next = $pagenum + 1;
$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-info">ถัดไป</a> ';
}
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบเตรียมสอนรายชั่วโมง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../pass_or_no.css">
</head>
<body>
<?php include_once('primary_slidebar.php'); ?>
    <div class="main">
    <div class="w3-container">
    <div class="display-3 text-center">ตรวจสอบเตรียมสอนรายชั่วโมง</div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>วัน/เดือน/ปี</th>
                <th>ชื่อ</th>
                <th>รหัสวิชา ชื่อวิชา (ชั้นเรียน)</th>
                <th>ดาวน์โหลด</th>
                <th>อนุมัติให้ผ่าน</th>
                <th>ไม่อนุมัติให้ผ่าน</th>
                <th>สถานะการส่ง</th>
            </tr>
        </thead>
        <tbody>
            <?php

                while($row =  mysqli_fetch_array($nquery)){
                ?>  
                        
                       
                    <tr>
                    <?php if(($row['grade_id'] == '9' ||$row['grade_id'] == '12') && $row['status_prepare_hours']=='Checking' ){ ?>
                        <td><?php echo $row['date_prepare']; ?></td>
                        <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
                        <td><?php echo  $row['code_subject'].' '.$row['name_subject'].' ('.$row['name_classroom'].')'; ?></td>
                        <td><a target ="_blank" href="download_hours.php?download_id=<?php echo $row["id_prepare"]; ?>" class="btn btn-dark">ดาวน์โหลด</a></td>
                        <td><a href="confirm.php?confirm_id=<?php echo $row['id_prepare']; ?>" class="btn btn-success" onclick="return confirm('คุณต้องการยืนยันข้อมูลนี้หรือไม่')">อนุมัติให้ผ่าน</td>
                        <td><a href="inconfirm.php?inconfirm_id=<?php echo $row['id_prepare'] ; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการส่งกลับข้อมูลนี้หรือไม่')">ไม่อนุมัติให้ผ่าน</td>
                        <td><?php if($row['status_prepare_hours']=='Checking'){?>
                            <p class="status">รอการตรวจสอบการส่ง</p>
                        <?php } ?></td>
                    <?php } ?>
                    </tr>    
                <?php } ?>
        </tbody>
    </table>
    </div>
    </div>

    
    <script src="../js/slime.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
    
    </body>
</html>