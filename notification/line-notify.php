
 <?php 

    $message = $_POST['message'];

    if (isset($_POST["submit"])) {
        /*if ( $firstname <> "" ||  $lastname <> "" ||  $phone <> "" ||  $email <> "" ) {
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            echo ("<script type=text/javascript>
                    alert('สมัครสมาชิกเรียบร้อย');
                </script>");
            header("location: notification.php");
        } else {
            echo ("<script type=text/javascript>
                    alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                </script>");
            header("location: notification.php");
        }*/

        if ( $firstname <> "" ||  $lastname <> "" ||  $phone <> "" ||  $email <> "" ) {  //js form
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            echo ("<script type=text/javascript>
                    alert('สมัครสมาชิกเรียบร้อย');
                    location.replace('notification.php');
                </script>");
        } else {
            echo "<script type=text/javascript>
                    alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                    location.replace('notification.php');
                </script>";
        }
    }

    function sendlinemesg() {
		// LINE LINE_API https://notify-api.line.me/api/notify
		// LINE TOKEN mhIYaeEr9u3YUfSH1u7h9a9GlIx3Ry6TlHtfVxn1bEu แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้
        define('LINE_API',"https://notify-api.line.me/api/notify");
        //define('LINE_TOKEN',"AwdpAwmOgcBDD00CnulluEJTNBVkwmnOX1I8kbLeven");   test token
        define('LINE_TOKEN', "UO1yducRKhwDFp9Oz6ime3wKKdxtIns7uA30JZbjpQ5");

        function notify_message($message) {
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData,'','&');
            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                                ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                ."Content-Length: ".strlen($queryData)."\r\n",
                    'content' => $queryData
                )
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents(LINE_API, FALSE, $context);
            $res = json_decode($result);
            return $res;
        }
    }


?>