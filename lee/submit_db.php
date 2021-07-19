<form id="myForm" action="submit_db.php" method="post">
    <input value="" name="latitude" id="latitude" hidden/>
    <input value="" name="longitude" id="longitude" hidden/>
    <input value="" name="in" hidden/>
    <button type="submit" class="btn" hidden>ลงชื่อเข้า</button>
</form>

<form id="myForm2" action="submit_db.php" method="post">
    <input value="" name="latitude2" id="latitude2" hidden/>
    <input value="" name="longitude2" id="longitude2" hidden/>
    <input value="" name="out" hidden/>
    <button type="submit" class="btn"  hidden>ลงชื่อออก</button>
</form>

<form id="myForm3" action="submit_db.php" method="post">
    <input value="" name="latitude3" id="latitude3" hidden/>
    <input value="" name="longitude3" id="longitude3" hidden/>
    <input value="" name="wfh" hidden/>
    <button type="submit" class="btn"  hidden>wfh</button>
</form>

<form id="myForm4" action="submit_db.php" method="post">
    <input value="" name="latitude4" id="latitude4" hidden/>
    <input value="" name="longitude4" id="longitude4" hidden/>
    <input value="" name="wfh_out" hidden/>
    <button type="submit" class="btn"  hidden>wfh_out</button>
</form>

<?php 
include("connect.php");
session_start();
//print_r($_POST);


 	//save workin
 	if(isset($_POST["work_in"])){
        echo "<script type='text/javascript'>";
        echo "var r = confirm('รับตำแหน่งปัจจุบัน');
            if (r == true) {
                getLocation();
            } else {
                window.location = 'home.php';
            }
        ";
        echo "function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
            
                }
        }";
        echo "function showPosition(position) {
            //var location = 'Latitude: ' + position.coords.latitude +  '<br>Longitude: ' + position.coords.longitude;
            //alert(position.coords.latitude);
            //alert(position.coords.longitude);

            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            document.getElementById('myForm').submit();
        }"; 
        echo "</script>";
        
     
    }else if(isset($_POST["latitude"]) && isset($_POST["longitude"]) && isset($_POST["in"]) ){
        $work_date = date('y-m-d');
        $username = $_SESSION['username'];
        $work_in = date('H:i:s');

        $_SESSION['work_in'] = $work_in;
        $_SESSION['work_date'] = $work_date;
          

        $lat = (float)$_POST["latitude"];
        $long = (float)$_POST["longitude"];
        
        //var_dump($lat);
        //var_dump($long);

        //test
        if( $lat >= 7.007073 && $lat <= 7.008228&& $long >= 100.494465 && $long <= 100.498227){

        }

        //true
        if($lat >= 7.007073 && $lat <= 7.008228&& $long >= 100.495465 && $long <= 100.498227){
                $sql = "INSERT INTO work ( work_date,work_in,username) VALUES ('$work_date','$work_in','$username')";
                $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        
                mysqli_close($conn);
                if($result){
                    echo "<script type='text/javascript'>";
                    echo "alert('บันทึกข้อมูลสำเร็จ');";
                    $_SESSION['work_in'] = $work_in; 
                    echo "window.location = 'home.php'; ";
                    echo "</script>";
                }else{
                    echo "<script type='text/javascript'>";
                    echo "alert('Error');";
                    echo "window.location = 'home.php'; ";
                    echo "</script>";
                }
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาอยู่ภายในพื้นที่ทำงาน ');";
            echo "window.location = 'home.php'; ";
            echo "</script>";
        }

    }

    //save work_wfh
 	else if(isset($_POST["work_wfh"])){
        echo "<script type='text/javascript'>";
        echo "var r = confirm('รับตำแหน่งปัจจุบัน');
            if (r == true) {
                getLocation();
            } else {
                window.location = 'home.php';
            }
        ";
        echo "function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
            
                }
        }";
        echo "function showPosition(position) {
            //var location = 'Latitude: ' + position.coords.latitude +  '<br>Longitude: ' + position.coords.longitude;
            //alert(position.coords.latitude);
            //alert(position.coords.longitude);

            document.getElementById('latitude3').value = position.coords.latitude;
            document.getElementById('longitude3').value = position.coords.longitude;
            document.getElementById('myForm3').submit();
        }"; 
        echo "</script>";
        
     
    }else if(isset($_POST["latitude3"]) && isset($_POST["longitude3"]) && isset($_POST["wfh"]) ){
        $work_date = date('y-m-d');
        $username = $_SESSION['username'];
        $work_in = date('H:i:s');
        $wfh = 1;
        $latitude = (float)$_POST["latitude3"];
        $longitude = (float)$_POST["longitude3"];

        $_SESSION['work_in'] = $work_in;
        $_SESSION['work_date'] = $work_date;
          

        $lat3 = (float)$_POST["latitude3"];
        $long3 = (float)$_POST["longitude3"];
        
        //var_dump($lat3);
        //var_dump($long);
        /*require_once("Geocoding.php");

        //use myPHPnotes\Geocoding;

        $geo = new Geocoding("AIzaSyB-Q9hh2BgaKFDYItRGGAyEBOVZBat3gF8");

        $addr = $geo->getAddress("48.858195","2.294432");
        var_dump($addr);



       /* echo "<script>
            alert('ok');
            //var latlng = {lat parseFloat(13.847860), lng parseFloat(100.604274)};
    
            /*var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location' 13.847860,100.604274}, function(results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        alert(results[1].formatted_address);
                    } else {
                        alert('No results found');
                    }
                } else {
                    alert('Geocoder failed due to ' + status);
                }
            });

        </script>";*/

        //true
        if($lat3 >= 7.007673 && $lat3 <= 7.008228&& $long3 >= 100.497465 && $long3 <= 100.498227){
        
        }

        $sql = "INSERT INTO work ( work_date,work_in,username,wfh,latitude,longtitude) VALUES ('$work_date','$work_in','$username',$wfh,$latitude,$longitude)";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

        mysqli_close($conn);
        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกข้อมูลสำเร็จ');";
            $_SESSION['work_in'] = $work_in; 
            echo "window.location = 'home.php'; ";
            echo "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('Error');";
            echo "window.location = 'home.php'; ";
            echo "</script>";
        }

    
    //save workout	
    }else if(isset($_POST["work_out"])){    
        echo "<script type='text/javascript'>";
        echo "var r = confirm('รับตำแหน่งปัจจุบัน');
            if (r == true) {
                getLocation();
            } else {
                window.location = 'home.php';
            }
        ";
        echo "function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
            
                }
        }";
        echo "function showPosition(position) {
            document.getElementById('latitude2').value = position.coords.latitude;
            document.getElementById('longitude2').value = position.coords.longitude;
            document.getElementById('myForm2').submit();
        }"; 
        echo "</script>"; 
        
        

    }else if(isset($_POST["latitude2"]) && isset($_POST["longitude2"]) && isset($_POST["out"]) ){
        
        $work_out = date('H:i:s');

        $lat2= (float)$_POST["latitude2"];
        $long2 = (float)$_POST["longitude2"];

        //var_dump($lat2);
        //var_dump($long2);

        //true
        if($lat2 >= 7.007000  && $lat2 <= 7.009000 && $long2 >= 100.494568 && $long2 <= 100.498944){

        }

        //test
        if($lat2 >= 7.007073 && $lat2 <= 7.008228&& $long2 >= 100.495465 && $long2 <= 100.498227){
            $sql = "UPDATE work SET work_out = '$work_out' WHERE username = '".$_SESSION['username']."'" ;
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

                mysqli_close($conn);
                if($result){
                echo "<script type='text/javascript'>";
                echo "alert('บันทึกข้อมูลสำเร็จ');";
                $_SESSION['work_out'] = $work_out;
                echo "window.location = 'home.php'; ";
                echo "</script>";
                }else{
                echo "<script type='text/javascript'>";
                echo "alert('Error');";
                echo "window.location = 'home.php'; ";
                echo "</script>";
                }
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาอยู่ภายในพื้นที่ทำงาน ');";
            echo "window.location = 'home.php'; ";
            echo "</script>";
        }

        //save wfh_out	
    }else if(!isset($_POST["latitude4"]) && isset($_POST["wfh_out"])){    
        echo "<script type='text/javascript'>";
        echo "var r = confirm('รับตำแหน่งปัจจุบัน');
            if (r == true) {
                getLocation();
            } else {
                window.location = 'home.php';
            }
        ";
        echo "function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
            
                }
        }";
        echo "function showPosition(position) {
            document.getElementById('latitude4').value = position.coords.latitude;
            document.getElementById('longitude4').value = position.coords.longitude;
            document.getElementById('myForm4').submit();
        }"; 
        echo "</script>"; 
        
        

    }else if(isset($_POST["latitude4"]) && isset($_POST["longitude4"]) && isset($_POST["wfh_out"]) ){
        
        $work_out = date('H:i:s');

        $lat4= (float)$_POST["latitude4"];
        $long4 = (float)$_POST["longitude4"];

        //var_dump($lat2);
        //var_dump($long2);

        //true
        if($lat4 >= 7.007673 && $lat4 <= 7.008228&& $long4 >= 100.497465 && $long4 <= 100.498227){

        }

        //test
        
            $sql = "UPDATE work SET work_out = '$work_out' WHERE username = '".$_SESSION['username']."'" ;
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

                mysqli_close($conn);
                if($result){
                echo "<script type='text/javascript'>";
                echo "alert('บันทึกข้อมูลสำเร็จ');";
                $_SESSION['work_out'] = $work_out;
                echo "window.location = 'home.php'; ";
                echo "</script>";
                }else{
                echo "<script type='text/javascript'>";
                echo "alert('Error');";
                echo "window.location = 'home.php'; ";
                echo "</script>";
                }

    }else if(isset($_POST["log_out"])){         
        

                echo "<script type='text/javascript'>";
                session_destroy();
                echo "alert('ออกจากระบบเรียบร้อยเเล้ว');";
                echo "window.location = 'index.php'; ";
                echo "</script>";
                echo "<script type='text/javascript'>";
                echo "alert('Error');";
                echo "window.location = 'home.php'; ";
                echo "</script>";
        }
          		
 ?> 
