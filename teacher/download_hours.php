<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    require_once __DIR__ . '../vendor/autoload.php';

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
            __DIR__ . '/tmp',
        ]),
        'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' => 'THSarabunNew Bold.ttf',
                'BI' => 'THSarabunNew BoldItalic.ttf'
            ]
        ],
        'default_font' => 'sarabun'
    
    ]);
    ob_start();

    

    require_once('../connection.php');

    if(isset($_REQUEST['download_id'])){
        try{
            $id = $_REQUEST['download_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_to_teach as pre, subject as sub, classroom as class  WHERE pre.id_prepare = :id AND pre.subject_id = sub.subject_id AND pre.class_id = class.class_id  ");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e){
            $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Page Hours</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <style>
body {
font-family: sarabun;
font-size: 20px;
}
table {
border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;

}
 
tr:nth-child(even) {
background-color: #dddddd;
}
</style>
</head>
<body">
    <div class="container">
    <form method="post" class="form-horizontal mt-5">
    <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-6">
                        <br>
                        <input type="text" name="" class="form-control"
                            value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>" readonly />
                    </div>
                </div>
            </div>





            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วิชา</label>
                    <div class="col-sm-6">
                        <br>
                        <input type="text" name="txt_name_role" class="form-control"
                            value="<?php echo $row['name_subject']; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชั้น</label>
                    <div class="col-sm-6">
                        <br>
                        <input type="text" name="txt_name_role" class="form-control"
                            value="<?php echo $row['name_classroom']; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วันที่</label>
                    <div class="col-sm-6">
                        <br>
                        <input type="date" name="txt_name_role" class="form-control"
                            value="<?php echo $row['date_prepare']; ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="form- text">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สาระการเรียนรู้/ตัวชี้วัด</label>
                    <div class="col-sm-6">
                        <br>
                        <textarea rows="10" cols="55" name="description" class="form-control" required
                           ><?php echo $row['learning']; ?> </textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">จุดประสงค์</label>
                    <div class="col-sm-6">
                    <br>
                        <textarea rows="10" cols="55" name="description" class="form-control" required
                            ><?php echo $purpose; ?> </textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สอนอย่างไร(กระบวนการจัดการเรียน)</label>
                    <div class="col-sm-6">
                        <textarea rows="10" cols="55" name="description" class="form-control" required
                           ><?php echo $how_to_teach; ?> </textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สื่อ/อุปกรณ์การเรียนรู้</label>
                    <div class="col-sm-6">
                    <br>
                        <textarea rows="10" cols="55" name="description" class="form-control"
                            required ><?php echo $media; ?> </textarea>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วิธีวัดและประเมินการสอน/เครื่องมือ</label>
                    <div class="col-sm-6">
                    <br>
                        <textarea rows="10" cols="55" name="description" class="form-control"
                            required><?php echo $measure; ?> </textarea>
                    </div>
                </div>
            </div>






       

            <?php 
                $html = ob_get_contents();
                $mpdf->WriteHTML($html);
                $mpdf->Output("MyReport_hours.pdf");
                ob_end_flush();
                

            ?>

            

            
    </form>
    <form method="post" class="form-horizontal mt-5">
    
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                <a href="hours.php" class="btn btn-danger">Cancel</a>
                <a href="MyReport_hours.pdf" class="btn btn-info">Download</a>
            </div>
        </div>
    </form>



    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script> document.location.href='MyReport_hours.pdf';</script>
    
</body>
</html>

