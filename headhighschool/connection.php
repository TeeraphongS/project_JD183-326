<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_multiplelogin";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<?php /* 
อันเก่าแบบPDO

    $db_host = "localhost"; // localhost server
    $db_user = "root"; // database username
    $db_password = ""; // database password
    $db_name = "php_multiplelogin"; // database name
    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_password,$db_name);
    mysqli_query($conn, "SET NAMES 'UTF8' ");
     //Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    try {

        $db = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_password);
        $db-> exec("SET NAMES 'UTF8' ");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//PDO::ATTR_DEFAULT_FETCH_MODE PDO::ATTR_ERRMODE
        
    } catch(PDOException $e) {
        $e->getMessage();
    }
*/

?>