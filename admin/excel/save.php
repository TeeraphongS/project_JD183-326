		
<?php

require '..../vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$inputFileName = $_FILES["myfile"]["name"];//ชื่อไฟล์ Excel ที่ต้องการอ่านข้อมูล $_FILES["myfile"]["name"]
 
$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
 
$i = 0;
$j = 1;
$data = [];
foreach($sheetData as $s => $k){
    foreach($k as $g){
        $i++;
        $data[$j][] = $g;
    }
    $j++;
}
 
include_once('connectDB.php');
 
//Insert Data To MySQL
$i = 2;
$j = 0;
foreach($data as $q[]){
    if($j >= 0){
        if($i > 3){
        
        $name = trim($q[0][0]);//A[0][0]
        $sql1 = "SELECT master_id FROM login_information WHERE user_role_id ='2' AND fname = '$name' ";
        $query1 = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_array($query1);
        $master_id = $row['master_id'];

        $date = trim($q[$j][0]);//B
        /*$sql6 = "SELECT choose_id FROM choose_a_teaching  WHERE date = '".$date."' ";
        $query6 = mysqli_query($conn,$sql6);
        $row6 = mysqli_fetch_array($query6);
        $master_id = $row6['master_id'];*/

        $time = trim($q[$j][1]);//C
        $sql5 = "SELECT time_id FROM time WHERE time_name = '".$time."' ";
        $query5 = mysqli_query($conn,$sql5);
        $row5 = mysqli_fetch_array($query5);
        $time_id = $row5['time_id'];

        $class = trim($q[$j][2]);
        $sql4 = "SELECT class_id FROM classroom WHERE name_classroom = '".$class."' ";
        $query4 = mysqli_query($conn,$sql4);
        $row4 = mysqli_fetch_array($query4);
        $class_id = $row4['class_id'];

        $code_subject = trim($q[$j][3]);//B
        $sql3 = "SELECT subject_id FROM subject WHERE code_subject = '".$code_subject."' ";
        $query3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_array($query3);
        $subject_id = $row3['subject_id'];
        
        $grade = trim($q[$j][4]);//A[1][0]
        $sql2 = "SELECT grade_id FROM grade_level WHERE grade_level_user = '$grade' ";
        $query2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_array($query2);
        $grade_id  = $row2['grade_id'];

        


		
        $sql = "INSERT INTO choose_a_teaching (master_id,grade_id,subject_id,class_id,time_id,date) VALUES ('$master_id','$grade_id ','$subject_id','$class_id','$time_id ','$date')";
        
		if (mysqli_query($conn, $sql)) {
            echo "<script>";
                    echo "alert('เพิ่มข้อมูลเสร็จสิ้น');";
                    echo "window.location ='../choose_a_teaching.php'; ";
            echo "</script>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	
	}
	$i++;
    }
    $j++;
}

mysqli_close($conn);
?>
