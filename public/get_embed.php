<?php
$channel = isset($_GET['channel']) ? $_GET['channel'] : null ;
$type = isset($_GET['type']) ? $_GET['type'] : 'channel' ;
$url = null;

switch ($type) {
    case 'chat':
        $url = 'http://api.justin.tv/api/channel/chat_embed/' . $channel . '?width=300&height=500&volume=50&auto_play=true';
        break;
    default:
        $url = 'http://api.justin.tv/api/channel/embed/' . $channel . '?width=620&height=500&auto_play=true';
        break;
}

$ch = curl_init();
curl_setopt_array($ch,
    array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false
        ));
curl_exec($ch);
curl_close($ch);