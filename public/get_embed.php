<?php
$channel = isset($_GET['channel']) ? $_GET['channel'] : null ;
$type = isset($_GET['type']) ? $_GET['type'] : 'channel' ;

switch ($type) {
    case 'chat':
        echo file_get_contents('http://api.justin.tv/api/channel/chat_embed/' . $channel . '?width=220&height=500');
        break;
    default:
        echo file_get_contents('http://api.justin.tv/api/channel/embed/' . $channel . '?width=700&height=500');
        break;
}