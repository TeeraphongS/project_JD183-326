<?php
    session_start();//คำสั่งต้องloginก่อนถึงเข้าได้

    require_once __DIR__ . '../../vendor/autoload.php';
    

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
    

    

    require_once('../connection.php');
            


    if(isset($_REQUEST['download_id'])){
        
            $id = $_REQUEST['download_id'];
            $sql = "SELECT * FROM prepare_to_teach as pre,choose_a_teaching as c,subject as sub, classroom  as class
            WHERE pre.choose_id = c.choose_id AND c.subject_id = sub.subject_id AND c.class_id =class.class_id AND pre.id_prepare = $id ";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
            $row = mysqli_fetch_array($result);
            extract($row);
        
    }
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title>หน้าดาวน์โหลดเตรียมสอนรายชั่วโมง</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="download_hours.css">

</head>
<body">

    <div class="container">
    <form method="post" class="form-horizontal mt-5">
    <div class="display-3 text-center">เตรียมสอนรายชั่วโมง</div>

    <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชื่อ-นามสกุล </label>
                    <div class="col-sm-6"><?php echo $_SESSION['User']; ?></div>
                </div>
            </div>
    
            <?php 
            $id = $_REQUEST['download_id'];
            $query = "SELECT * FROM prepare_to_teach as pre,choose_a_teaching as c,subject as sub, classroom  as class
            WHERE pre.choose_id = c.choose_id AND c.subject_id = sub.subject_id AND c.class_id =class.class_id AND pre.id_prepare = '".$id."' ";
            $result1 = mysqli_query($conn,$query);
            ?>



            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">
                     วิชา</label>
                    <div class="col-sm-6">
                    <?php foreach($result1 as $row1){?>
                         
                        <?php  echo $row1['name_subject']; ?>
                    <?php }?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">ชั้น</label>
                    <div class="col-sm-6">
                    <?php foreach($result1 as $row1){?>
                   
                   
                        <?php echo $row1['name_classroom']; ?>
                        
                        
                    <?php }?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วันที่</label>
                    <div class="col-sm-6">
                    <?php echo $row['date_prepare']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สาระการเรียนรู้/ตัวชี้วัด</label>
                    <div class="col-sm-6">
                        <?php echo $row['learning']; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">จุดประสงค์</label>
                    <div class="col-sm-6">
                        <?php echo $purpose; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สอนอย่างไร(กระบวนการจัดการเรียน)</label>
                    <div class="col-sm-6">
                        <?php echo $how_to_teach; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">สื่อ/อุปกรณ์การเรียนรู้</label>
                    <div class="col-sm-6">
                    <?php echo $media; ?>
                    </div>
                </div>
            </div>

            <div class="form- text-left">
                <div class="row">
                    <label for="name_role" class="col-sm-3 control-label">วิธีวัดและประเมินการสอน/เครื่องมือ</label>
                    <div class="col-sm-6">
                    <?php echo $measure; ?>
                    </div>
                </div>
            </div>






       

            <?php 
             //เป็นการกำหนด Font LilyUPC ตัวปกติ ขนาด 16
                $html = ob_get_contents();
                $mpdf->WriteHTML($html);
                $mpdf->Output("MyReport_hours.pdf");
                
                ob_end_flush();
                

            ?>

            

            
    </form>
    <!--<form method="post" class="form-horizontal mt-5">
    
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-9 mt-5">
                <a href="hours.php" class="btn btn-danger">Cancel</a>
                <a href="MyReport_hours.pdf" class="btn btn-info">Download</a>
            </div>
        </div>
    </form>-->



    <script src="js/slime.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>document.location.href='MyReport_hours.pdf';</script>
    
</body>
</html>

