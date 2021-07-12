<?php
$date1 = isset($_POST['date1']) ? $_POST['date1'] : '';
$date2 = isset($_POST['date2']) ? $_POST['date2'] : '';
$datetime1 = new DateTime($date1);
$datetime2 = new DateTime($date2);
$interval = $datetime1->diff($datetime2);
$diff_result = $interval->format('%y ปี %m เดือน  %d วัน');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
 <div class="jumbotron text-center">
   <h1>เปรียบเทียบวันที่ ปี เดือน วัน ผลต่างระหว่างวันที่ 2 วัน</h1>
 </div>
 
 <div class="container">
   <div class="row">
  <form class="form-horizontal" method="POST">
       <div class="form-body">
     <!-- Begin cloned dynamic list section -->
     <div id="date1" class="clonedInput_4">
     <div class="form-group">
     <label class="control-label col-md-3 label_date">Date 1</label>
     <div class="col-md-3 fields">
        <div id="name_data">
        <div class="input-group">
        <input class="form-control form-control-inline input-medium datepicker"
         name="date1" value="<?php echo $date1;?>" />       
        </div>
        </div>
     </div>
     </div>
     </div>
   
     <div id="date2" class="clonedInput_4">
     <div class="form-group">
     <label class="control-label col-md-3 label_date">Date 2</label>
     <div class="col-md-3 fields">
        <div id="name_data">
        <div class="input-group">
        <input class="form-control form-control-inline input-medium datepicker"
         name="date2" value="<?php echo $date2;?>" />       
        </div>
        </div>
     </div>
     </div>
     </div>
   
     <div class="clonedInput_4">
    <div class="form-group">
     <label class="control-label col-md-3 label_date">ผลลัพธ์</label>
     <div class="col-md-3 fields">
        <div id="name_data">
        <div class="input-group">
       <?php echo $diff_result;?>
        </div>
        </div>
     </div>      </div>
     </div>
   
     <div class="form-group">
     <label class="control-label col-md-3"></label>
     <div class="col-md-4">
     <button type="submit" id="btnAdd_4" name="btnAdd_4" class="btn btn-primary">เปรียบเทียบวันที่</button>
     </div>
     </div>
     </div>
  </form>
 </div>


 <script>
 $('.datepicker').datepicker({});
 </script>
</body>
</html>