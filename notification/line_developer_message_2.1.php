
<?php 

http_response_code(200);

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

function sendlinemesg() {
    // LINE LINE_API https://notify-api.line.me/api/notify
    // LINE TOKEN mhIYaeEr9u3YUfSH1u7h9a9GlIx3Ry6TlHtfVxn1bEu แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้
    //define('LINE_token_API',"https://api.line.me/oauth2/v2.1/token");
    define('LINE_MESSAGE_API',"https://api.line.me/v2/bot/message/reply");
    //define('LINE_TOKEN',"AwdpAwmOgcBDD00CnulluEJTNBVkwmnOX1I8kbLeven");   test token
    //define('LINE_TOKEN', "UO1yducRKhwDFp9Oz6ime3wKKdxtIns7uA30JZbjpQ5");    test_2 token
    define('LINE_TOKEN', "xMYoABT35hNDVM1fxx6yQIxCyeJExKK0zagEyCtB5MZ");
    define('LINE_MESSAGE_TOKEN', "7i0FAp8Hxn4Ud6lD7sTh1jvQBfjGG5wndzvv2Bp2Jsp4tE0HoFFPI5Xq7EUOL8LZWsFlH/V/vgkUAijILB2QSN22kFrOK2RhkVb3DDDtCrp7dnilUZl4YvQt6Sss7Pc/pj2PnYyodrFi1vkmbNmZ3QdB04t89/1O/w1cDnyilFU=");

    function notify_message($message) {
        $queryData = array("type" => "text",
                           "text" => "test");
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n"
                            ."Authorization: Bearer ".LINE_MESSAGE_TOKEN."\r\n",
                'content' => json_encode($queryData)
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_MESSAGE_API, FALSE, $context);
        $res = json_decode($result);
        echo $res;
        return $res;
    }
}

function getURL() {
    $URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") 
           . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    return ($URL);
}
?>