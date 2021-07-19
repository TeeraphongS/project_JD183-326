<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าอัพโหลดข้อมูลผ่านทางexcel</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>
<div class="main">
    <div class="container">
        <div class="form - text-center">
            <div class="display-3 text-center">หน้าอัพโหลดข้อมูลผ่านทางexcel</div>
            <br>
                <form action="save.php" method="post" enctype="multipart/form-data">
                <input type="file" name="myfile"  required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" /> 
                <button type="submit" class="btn btn-info">อัพโหลด</button>
                </form>
            
        </div>
    </div>
</div>
</div>
<div class="form-group text-center">
                <div class="col-sm-offset-3 col-sm-9 mt-5">
                    <a href="choose_a_teaching.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
</body>
</html>