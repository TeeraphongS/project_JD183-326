<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    require_once __DIR__ . '/vendor/autoload.php';

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

    

    require_once('connection.php');

    if(isset($_REQUEST['download_id'])){
        try{
            $id = $_REQUEST['download_id'];
            $select_stmt = $db->prepare("SELECT * FROM prepare_hours as pre, subject_user as sub, classroom_user as class  WHERE pre.id_prepare = :id AND pre.subject_id = sub.subject_id AND pre.class_id = class.class_id  ");
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
    <h1 style="text-align:center">รายละเอียดของข้อมูล</h1>

<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px; " border = 2px>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">ชื่อ - สกุล</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php  echo $_SESSION['fname'].' '.$_SESSION['lname']; ?></td>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">วิชา</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $row['name_subject']; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="10%">ชั้น</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $row['name_classroom']; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">วันที่</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $row['date_prepare']; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">สาระการเรียนรู้/ตัวชี้วัด</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $row['learning']; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">จุดประสงค์</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $purpose; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">สอนอย่างไร(กระบวนการจัดการเรียน)</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $how_to_teach; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">สื่อ/อุปกรณ์การเรียนรู้</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $media; ?></td>
    </tr>
    </tr>
    <tr style="border:1px solid #000;padding:4px;">
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="10%">วิธีวัดและประเมินการสอน/เครื่องมือ</td>
        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"width="15%"><?php echo $measure; ?></td>
    </tr>

</thead>
</table>

            </div>

            <?php 

               $html = ob_get_contents();
                $mpdf->WriteHTML($html);
                $mpdf->Output("MyReport_hours.pdf");
                ob_end_flush();
                

            ?>

            

            
    </form>

    <form method="post" class="form-horizontal mt-5">
    
        <div class="form-group text-center">
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

