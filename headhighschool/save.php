<?php
    require_once "excel/PHPExcel.php";//เรียกใช้ library สำหรับอ่านไฟล์ excel
        $tmpfname = "test_excel.xlsx";//กำหนดให้อ่านข้อมูลจากไฟล์จากไฟล์ชื่อ
       //สร้าง object สำหรับอ่านข้อมูล ชื่อ $excelReader
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $excelObj = $excelReader->load($tmpfname);//อ่านข้อมูลจากไฟล์ชื่อ test_excel.xlsx
        $worksheet = $excelObj->getSheet(0);//อ่านข้อมูลจาก sheet แรก
        $lastRow = $worksheet->getHighestRow(); 
       //นับว่า sheet แรกมีทั้งหมดกี่แถวแล้วเก็บจำนวนแถวไว้ในตัวแปรชื่อ $lastRow
   
        echo "<table>";
        for ($row = 1; $row <= $lastRow; $row++)//วน loop อ่านข้อมูลเอามาแสดงทีละแถว
       {
           echo "<tr><td>";
             echo $worksheet->getCell('A'.$row)->getValue();//แสดงข้อมูลใน colum A
           echo "</td><td>";
              echo $worksheet->getCell('B'.$row)->getValue();//แสดงข้อมูลใน colum B
            echo "</td><tr>";
        }
        echo "</table>";   
?>