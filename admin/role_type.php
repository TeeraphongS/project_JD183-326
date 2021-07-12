<?php

    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    if (!isset($_SESSION['admin_login'])) {//คำสั่งต้องloginก่อนถึงเข้าได้
        header("location: ../index.php");
    }


    require_once('../connection.php');
            $strKeyword = null;// กำหนดค่าsearch
            $search = isset($_GET['search']) ? $_GET['search']:' ';

            $sql1=mysqli_query($conn,"SELECT COUNT(user_role_id) FROM user_role");
            
                        $row = mysqli_fetch_row($sql1);
                    
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
                    
                        $sql = "SELECT * from user_role  ORDER BY user_role_id DESC $limit";
                        if(isset($_GET['search'])){ 
                            $search = $_GET['search'];
                            $sql = "SELECT * from  user_role WHERE   name_role LIKE '%" . $search . "%' ORDER BY user_role_id DESC $limit ";
                            $strKeyword = $_GET['search'];// รับค่า search
                        }
                        $nquery=mysqli_query($conn,$sql);
                    
                        $paginationCtrls = '';
                    
                        if($last != 1){
                    
                            if ($pagenum > 1) {
                        $previous = $pagenum - 1;
                                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'&&search='.$strKeyword.'" class="btn btn-info">ย้อนกลับ</a> &nbsp; &nbsp; ';
                        
                                for($i = $pagenum-4; $i < $pagenum; $i++){
                                    if($i > 0){
                                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&&search='.$strKeyword.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                                    }
                            }
                        }
                        
                            $paginationCtrls .= ''.$pagenum.' &nbsp; ';
                        
                            for($i = $pagenum+1; $i <= $last; $i++){
                                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&&search='.$strKeyword.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                                if($i >= $pagenum+4){
                                    break;
                                }
                            }
                        
                        if ($pagenum != $last) {
                        $next = $pagenum + 1;
                        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'&&search='.$strKeyword.'" class="btn btn-info">ถัดไป</a> ';
                        }
                            }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บทบาท</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../pass_or_no.css">
</head>

<body>
    <?php include_once('slidebar_admin.php'); ?>
    <div class="main">
        <div class="container">
            <div class="display-3 text-center">บทบาทผู้ใช้</div>

            <a href="add_role.php">
                <button type="button" class="btn btn-success mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                        </path>
                    </svg>
                    เพิ่มบทบาท
                </button>
            </a>
             <!-- ปุ่ม Search -->
             <ul class="nav nav-pills pull-right"> 
            <div class="d-flex pb-3" >
            <input class="form-control me-2" type="search" placeholder="ค้นหาบทบาท" aria-label="Search"
                        id="Search" onchange="search_input()">
                    <button class=" btn btn-outline-success" type="submit" onclick='search()'>ค้นหา</button>
            </div>
            </div>

        <!-- ไอนี่ส่วน search ต้องใส่ ไม่ใส่แล้วดึงข้อมูลไม่ได้ แต่ซ่อน tag p ไว้ 😎😎 -->
        <script>
        function search_input() {
            var search = document.getElementById("Search").value;
            return search;
        }

        function search() {
            location.href = "role_type.php?search=" + search_input();
        }
        </script>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ชื่อบทบาท</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                        <th>แก้ไขสถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                while($row =  mysqli_fetch_array($nquery)){
                ?>

                    <tr>
                        <td><?php echo $row["name_role"]; ?></td>
                        <td><?php if($row["status_role"] == 'Active'){?>
                            <p class="active">ใช้งานได้</p>
                        <?php } elseif($row["status_role"] == 'Inactive'){?>
                            <p class="inactive">ถูกระงับการใช้งานได้</p>
                       <?php } ?></td>
                        <td><a href="edit_role.php?update_id=<?php echo $row['user_role_id']; ?>"
                                class="btn btn-warning">แก้ไข</td>
                        <td><a href="delete_role.php?delete_id=<?php echo $row['user_role_id']; ?>"
                                class="btn btn-danger" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบข้อมูล</td>
                        <td><a href="change_status_role.php?change_id=<?php echo $row["user_role_id"]; ?>"
                                class="btn btn-info "
                                onclick="return confirm('คุณต้องการเปลี่ยนสถานะของบทบาทหรือไม่')">แก้ไขสถานะ</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    </div>


    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>