
<?php 

$URL = getURL();

$paramPos = strpos($URL, "?");

    if ($paramPos === FALSE){
        echo "incompatible value<br>";
        echo "You didn't pass argument";
        return;
    }
    
    if (strpos($URL, "&")){
        echo "incompatible value<br>";
        echo "You can only pass 1 argument";
    }

    $message = substr($URL, $paramPos + 1);
    $message = urldecode($message);

    sendlinemesg();
    header('Content-Type: text/html; charset=utf8');
    $res = notify_message($message);
    echo ("<script type=text/javascript>
            location.replace('notification.php');
        </script>");

function sendlinemesg() {
    // LINE LINE_API https://notify-api.line.me/api/notify
    // LINE TOKEN mhIYaeEr9u3YUfSH1u7h9a9GlIx3Ry6TlHtfVxn1bEu แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้
    define('LINE_API',"https://notify-api.line.me/api/notify");
    //define('LINE_TOKEN',"AwdpAwmOgcBDD00CnulluEJTNBVkwmnOX1I8kbLeven");   test token
    //define('LINE_TOKEN', "UO1yducRKhwDFp9Oz6ime3wKKdxtIns7uA30JZbjpQ5");    test_2 token
    define('LINE_TOKEN', "xMYoABT35hNDVM1fxx6yQIxCyeJExKK0zagEyCtB5MZ");

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

function getURL() {
    $URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") 
           . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    return ($URL);
}
?>