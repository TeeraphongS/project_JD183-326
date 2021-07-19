<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--><!-- icon -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="sidebar">
        <nav>
            <ul>
                <li><a href="teacher_home.php"><i class="fa fa-fw fa-home"></i> หน้าหลัก</a></li>
                <li class="dropdown"> <a href="hours.php"><i class="fa fa-fw fa-user"></i> เตรียมสอน<span>&rsaquo;</span></a>
                    <ul>
                        <li class="dropdown_two"><a href="add_hours.php">เพิ่มข้อมูล</a></li>
                        <li class="dropdown_two"><a href="hours.php">รายละเอียด</a></li>
                        <li class="dropdown_two"><a href="pass_work.php">อนุมัติ</a></li>
                    </ul>
                </li>
                <li class="dropdown"> <a href="week.php"><i class="fa fa-fw fa-user"></i> สรุปรายสัปดาห์<span>&rsaquo;</span></a>
                    <ul>
                        <li class="dropdown_two"><a href="add_week.php">เพิ่มข้อมูล</a></li>
                        <li class="dropdown_two"><a href="week.php">รายละเอียด</a></li>
                        <li class="dropdown_two"><a href="pass_work_week.php">อนุมัติ</a></li>
                    </ul>
                </li>
                <li><a href="###" onclick=" logout()"><i class="fa fa-sign-out"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>
    </div>

    <script>
    function logout() {
        var reallyLogout = confirm("คุณต้องการออกจากระบบใช่หรือไม่?");
        if (reallyLogout) {
            location.href = "../logout.php";
        }
    }
    var el = document.getElementById("logout");
    if (el.addEventListener) {
        el.addEventListener("click", logoutfunction, false);
    } else {
        el.attachEvent('onclick', logoutfunction);
    }
    </script>

</body>

</html>