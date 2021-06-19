<?php   

    session_start();
    require_once('../connection.php');

    $client_id = 'wpUIRBGGA6B7RaRF02BrON';
    $api_url = 'https://notify-bot.line.me/oauth/authorize?';
    $callback_url = 'http://localhost/TTPS/notification/line-notify-upd_auth.php';
        
    $state = "mylinenotify";
        
    haveState();
        
    $headerOptions = array(
        'http' => array(
            'method' => 'GET',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
            ."response_type: code\r\n"
            ."client_id: ".$client_id."\r\n"
            ."redirect_uri: ".$callback_url."\r\n"
            ."scope: notify\r\n"
            ."state: $state\r\n"
            )
        );
        //echo "p";
        //$context = stream_context_create($headerOptions);
        //echo $context;
        //$result = file_get_contents($api_url, FALSE, $context);
        //echo $result;
        //$res = json_decode($result);
        //echo $res;
        
    function haveState(){

        if(isset($_SESSION['code'])){
            echo "haveSession";

            addDatabase();

            return;

        }
        if(isset($_GET['state'])){
            echo "haveStage<br>";
            //echo $_GET['state'];
            checkState();
        }
        else {
            auth();
        }
    }
        
    function checkState(){
        
        if($_GET['state'] === $GLOBALS['state']){
            echo "state<br>";
                        
            clearState();

        }

        echo "<br>".$_GET['state']." ".$GLOBALS['state'];
        echo("<br>State is not match. Please try again.");

    }
            
    function auth(){
            
        $query = [
            'response_type' => 'code',
            'client_id' => $GLOBALS['client_id'],
            'redirect_uri' => $GLOBALS['callback_url'],
            'scope' => 'notify',
            'state' => $GLOBALS['state']
        ];
            
        $queryData = $GLOBALS['api_url'] . http_build_query($query);
            
        //echo $queryData;
            
        header("location: $queryData");
            
    }
        
    function clearState(){
        $code = $_GET['code'];
        $_SESSION['code'] = $_GET['code'];

        echo $_SESSION['code'];

        header("location: line-notify-upd_auth.php");

        //echo $_SESSION['login_type'];
        //echo "<br>".$_SESSION['user_login'];

    }
    
    function addDatabase(){

        //ยังไม่เรียบร้อย แต่ว่าพอใช้งานได้
        //อยากให้มีระบบตรวจทานว่าเพิ่มไปให้ใคร
        //ถ้ามีอีเมล์ก็ตรวจว่าตรงกับที่มีไหม
        //ถ้าตรง ให้ทำการเพิ่มไปใน database และแจ้งว่าเพิ่มลงในอีเมล์นี้แล้ว
        //แล้วถามเพิ่มว่า ไม่ใช่บัญชีนี้หรือ
        //ถ้าไม่ตรง ให้เพิ่มลงใน guestXX ก่อน
        //แล้วแจ้งว่า เพิ่มลงใน guest แล้ว
        //ถามเพิ่มว่า เพิ่มชื่อลงในระบบ

        //เวลาที่ใช้บัญชีที่ทำการเชื่อม line notify แล้ว
        //ให้ดึงข้อมูลไปใช้ได้ทันที ไม่ต้องขอใหม่


        //ปัญหาที่ยังไม่แก้ไข
        //การจะใช้งาน line notify จำเป็นต้อง log in ในระบบก่อน
        //ไม่เช่นนั้นจะทำการเพิ่มข้อมูลไม่ขึ้น
        //เพราะพยายามเชื่อมกับ database จึงจำเป็นต้องมี master_id

    
        if($_SESSION['login_type']){
            echo $_SESSION['user_login'];
        }

        try{
            if(!isset($errorMsg)){
                $insert_stmt = $GLOBALS['db']->prepare("SELECT * FROM login_information WHERE username = :id;");
                $insert_stmt->bindParam(":id", $_SESSION['user_login']);
                //$insert_stmt->bindParam(":code", $code);
                //$insert_stmt->bindParam(":id", $id);
                
                if($insert_stmt->execute()){
                    $insertMsg = "Updated successfully.";
                    //header("refresh:1, line-notify-upd_auth.php");
                    
                    while($row = $insert_stmt->fetch(PDO::FETCH_ASSOC)) {
                        $_SESSION['dbid'] = $row['master_id'];

                        //echo $_SESSION['dbid'];

                        try{
                            if(!isset($errorMsg)){

                                //echo $_SESSION['code']."<br>";
                                //echo $_SESSION['dbid']."<br>";

                                $insert_stmt = $GLOBALS['db']->prepare("UPDATE notify
                                                                            SET code = :code
                                                                            WHERE master_id = :n;");
                                $insert_stmt->bindParam(":code", $_SESSION['code']);
                                $insert_stmt->bindParam(":n", $_SESSION['dbid']);
                                //$insert_stmt->bindParam(":id", $id);
                                
                                if($insert_stmt->execute()){
                                    $insertMsg = "Updated successfully.";
                                    //header("refresh:1, line-notify-upd_auth.php");   
                                }
                            }
                        } catch (PDOException $e){
                            echo $e->getMessage();
                        }
                    }   
                }
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }

        getToken();

        //echo $dbid;
        /*echo ("<script type='text/javascript'>
                if(confirm('Hello.')){
                    $_SESSION['']
                }
                else {

                }
                </script>");  */      

        /*try{
            if(!isset($errorMsg)){
                $insert_stmt = $db->prepare("UPDATE notify
                                                SET user_id :code
                                                WHERE master_id = ':id';");
                $insert_stmt->bindParam(":code", $code);
                $insert_stmt->bindParam(":id", $id);
                
                if($insert_stmt->execute()){
                    $insertMsg = "Updated successfully.";
                    header("refresh:1, line-notify-upd_auth.php");
                }
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }*/
    }

    function getToken(){

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS/notification/line-notify-upd_auth.php';

        //var_dump($queries);
        $fields = [
            'grant_type' => 'authorization_code',
            'code' => $_SESSION['code'],
            'redirect_uri' => $callback_url,
            'client_id' => $client_id,
            'client_secret' => $client_secret
        ];
        
        try {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
            $res = curl_exec($ch);
            curl_close($ch);
        
            if ($res == false)
                throw new Exception(curl_error($ch), curl_errno($ch));
        
            $json = json_decode($res);

            //echo ("<br>".$json->access_token);

            //echo "<br>".$_POST['access_token'];

            //$_SESSION['token'] = $_POST['access_token'];

            //echo json_encode($fields)."<br>";
            //echo $res;

            $_SESSION['token'] = $json->access_token;


            try{
                if(!isset($errorMsg)){

                    //echo $_SESSION['code']."<br>";
                    //echo $_SESSION['dbid']."<br>";

                    $insert_stmt = $GLOBALS['db']->prepare("UPDATE notify
                                                                SET token = :token
                                                                WHERE master_id = :n;");
                    $insert_stmt->bindParam(":token", $_SESSION['token']);
                    $insert_stmt->bindParam(":n", $_SESSION['dbid']);
                    //$insert_stmt->bindParam(":id", $id);
                    
                    if($insert_stmt->execute()){
                        $insertMsg = "Updated successfully.";
                        //header("refresh:1, line-notify-upd_auth.php");   
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        
            //var_dump($json);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
            //var_dump($e);
        }
    }
    
?>