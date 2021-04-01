<?php 
    session_start();
    require 'vendor/autoload.php';
    $conn = mysqli_connect("localhost","root","","php_multiplelogin");

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


    if(isset($_POST['import_file_btn']))
    {
        $allowed_ext = ['xls','csv','xlsx'];
        $flieName = $_FILES['import_file']['name'];
        $checking = explode(".", $flieName);
        $flie_ext = end($checking);

        if(in_array($flie_ext, $allowed_ext))
        {
            $targetPath = $_FILES['import_file']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
            $data = $spreadsheet->getActivesheet()->toArray();

            foreach($data as $row)
            {
                $excel_id = $row[0];
                $exfname = $row[1];
                $exlname = $row[2];
                $number_phone = $row[3];

                $checkStudent = "SELECT excel_id FROM import_excel WHERE excel_id ='$excel_id'";
                $checkStudent_result = mysqli_query($conn,$checkStudent);

                if(mysqli_num_rows($checkStudent_result) > 0)
                {
                    $up_query ="UPDATE import_excel SET exfname='$exfname', exlname = '$exlname', number_phone = '$number_phone' WHERE excel_id='$excel_id'";
                    $up_result = mysqli_query($conn,$up_query);
                    $msg = 1;
                }
                else
                {
                    $in_query ="INSERT INTO import_excel (exfname,exlname,number_phone) VALUES('$exfname','$exlname','$number_phone')";
                    $in_result = mysqli_query($conn,$in_query);
                    $msg = 1;
                }
            }

            if(isset($msg))
            {
                $_SESSION['status'] = "Flie Imported Successfully";
                header("location: test.php");
            }
            else
            {
                $_SESSION['status'] = "Flie Import Fail";
            header("Location : test.php");
            }

        }
        else
        {
            $_SESSION['status'] = "Invalid File";
            header("Location : test.php");
            exit(0);
        }

    }



?>