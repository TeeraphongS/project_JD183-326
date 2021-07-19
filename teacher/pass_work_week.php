<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    require_once('../connection.php');
    date_default_timezone_set('Asia/Bangkok');
    $id =$_SESSION['UserID'];

    $query=mysqli_query($conn,"SELECT COUNT(id_prepare_week) FROM weekly_summary ");
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

    $nquery=mysqli_query($conn,"SELECT * from  weekly_summary  as week,choose_a_teaching as c, subject as sub, classroom as class,login_information as login
    WHERE week.choose_id = c.choose_id AND c.subject_id =sub.subject_id AND c.class_id = class.class_id AND c.master_id = login.master_id AND  login.master_id = $id ORDER BY id_prepare_week DESC $limit");

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
    <title>สรุปจุดประสงค์รายสัปดาห์</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../pass_or_no.css">
</head>

<body>
<?php include_once('sidebar.php'); ?>
    <div class="main">
        <div class="container">
            <div class="jumbotron">
                <div class="text-center">
                    <h1>สรุปจุดประสงค์รายสัปดาห์ที่ได้รับการอนุมัติ</h1>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>วัน/เดือน/ปี</th>
                        <th>รหัสวิชา ชื่อวิชา (ชั้นเรียน)</th>
                        <th>แก้ไข</th>
                        <th>ดาวน์โหลด</th>
                        <th>สถานะการส่ง</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                while($row =  mysqli_fetch_array($nquery)){
                ?>

                    <?php $row["date_prepare_week"];
                     $id =$_SESSION['UserID']; ?>
                    <tr>
                    
                    <?php if($row['status_prepare_week'] =='Complete' && $row['master_id'] == $id && $row['status_choose'] == 'Active'){?>
                        <td><?php echo $row["date_prepare_week"]; ?></td>
                        <td><?php echo  $row['code_subject'].' '.$row['name_subject'].' ('.$row['name_classroom'].')'; ?></td>
                        <td><a href="edit_week.php?update_id=<?php echo $row["id_prepare_week"]; ?>"
                                class="btn btn-warning">แก้ไข</td>
                        <td><a target="_blank"
                                href="download_week.php?download_id=<?php echo $row["id_prepare_week"]; ?>"
                                class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg> ดาวน์โหลด</a></td>
                        
                        <td><?php if($row['status_prepare_week'] == 'Complete'){ ?>
                            <p class="status_pass">ผ่านการตรวจสอบ</p>
                   <?php }?>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            
                <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
        </div>
        <div class="col-lg-2">
        </div>
        </div>
    </div>
    </div>

    <a href="teacher_home.php" class="btn btn-warning">Back</a>
    <a href="../logout.php" class="btn btn-danger">Logout</a>
    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>


</body>

</html>