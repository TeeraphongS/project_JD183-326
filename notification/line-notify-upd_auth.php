<?php   

    session_start();
    require_once('../connection.php');

    if(!isset($_SESSION['login_type'])){
        $_SESSION['login_type'] = 0;
        http_response_code(403);
        //header("location: ../index.php");
        return;
    }
    if($_SESSION['login_type'] === 0){
        http_response_code(403);
        //header("location: ../index.php");
        return;
    }

    $client_id = 'wpUIRBGGA6B7RaRF02BrON';
    $api_url = 'https://notify-bot.line.me/oauth/authorize?';
    $callback_url = 'http://localhost/TTPS/notification/line-notify-upd_auth.php';
        
    $state = "mylinenotify";
        
    haveState();

    message();
        
    function haveState(){

        if(isset($_SESSION['code'])){
            echo "haveSession";

            addDatabase();

            return;

        }
        if(isset($_GET['state'])){
            echo "haveStage<br>";
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
        header("location: $queryData");
            
    }
        
    function clearState(){
        $code = $_GET['code'];
        $_SESSION['code'] = $_GET['code'];

        echo $_SESSION['code'];

        header("location: line-notify-upd_auth.php");
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
                $insert_stmt = $GLOBALS['db']->prepare("UPDATE notify
                                                                SET code = :code
                                                                WHERE master_id = :n;");
                $insert_stmt->bindParam(":id", $_SESSION['user_login']);
                $insert_stmt->bindParam(":code", $_SESSION['code']);
                $insert_stmt->bindParam(":n", $_SESSION['dbid']);
                
                if($insert_stmt->execute()){
                    $insertMsg = "Updated successfully.";  
                }
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }

        getToken();

    }

    function getToken(){

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS/notification/line-notify-upd_auth.php';

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

            $_SESSION['token'] = $json->access_token;


            try{
                if(!isset($errorMsg)){

                    $insert_stmt = $GLOBALS['db']->prepare("UPDATE notify
                                                                SET token = :token
                                                                WHERE master_id = :n;");
                    $insert_stmt->bindParam(":token", $_SESSION['token']);
                    $insert_stmt->bindParam(":n", $_SESSION['dbid']);
                    
                    if($insert_stmt->execute()){
                        $insertMsg = "Updated successfully.";   
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
    
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

    function message()
    {
        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS/notification/line-notify-upd_auth.php';

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

            $_SESSION['token'] = $json->access_token;
        
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

    //function message(string $msg)
    {
        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS/notification/line-notify-upd_auth.php';

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

            $_SESSION['token'] = $json->access_token;
        
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    }
    
?>