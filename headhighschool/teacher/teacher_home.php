<?php 
  session_start();
  require_once('../connection.php');

  if (!isset($_SESSION['teacher_login'])) {
      header("location: ../index.php");
  }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <?php include_once('slidebar_teacher.php'); ?>
    <div class="main">

        <div class="text-center mt-5">
            <div class="container">
                <div class="display-5 text-center">
                    <h1>เตรียมสอนรายชั่วโมง</h1>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th>วัน/เดือน/ปี</th> -->
                            <th>ปีการศึกษา</th>
                            <th>ดาวน์โหลดตารางสอน</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $id =$_SESSION['UserID'];
                    $sql = "SELECT * FROM choose_a_teaching as c,year as y WHERE c.year_id = y.year_id AND y.status_year = 'Active'  ";
                    $query = mysqli_query($conn,$sql) ;
                    $row = mysqli_fetch_array($query);
                    ?>



                        <tr>

                            <?php if($row['master_id'] == $id && $row['status_choose'] == 'Active'){?>
                            <td><?php echo $row["term"].'/'.$row["year_name"]; ?></td>
                            <td><a target="_blank"
                                    href="download_teaching.php?download_id=<?php echo $row["choose_id"]; ?>"
                                    class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg> ดาวน์โหลด</a></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>



</body>

</html>