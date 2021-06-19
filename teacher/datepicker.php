<?php
    $date =  date('m/d/Y');
    $date2 = isset($_POST['txt_date']) ? $_POST['txt_date'] : '';
    ?>
    <?php
if(date('m/d/Y') == '04/16/2021'){?>
    <?php if(time()>=strtotime("06:00:00") && time()<strtotime("06:00:00 + 11 hour ")){ ?>
    <script>
    function myFunction() {
        alert("หมดเวลาในการส่งแล้ววันนี้");
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        document.write(today);
        document.location.href = 'hours.php';
    }
    </script>
    <?php } ?>
    <?php if(time()>=strtotime("17:00:00") && time()<strtotime("17:00:00 + 13 hour ")){ ?>
    <script>
    function myFunction() {
        alert("เสร็จสิ้น");
    }
    </script>
    <?php } ?>
    <?php }else{} ?>