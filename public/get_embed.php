<?php
$allowed_channels = array('horusstv', 'fenixcoaching', 'rommeltj', 'jimrsng', 'famousc2',
                     'zafhir', 'beefchief3', 'lowcloud1', 'xesk1e', 'day9tv',
                     'zapo_colorado', 'xgsrevenge', 'angryzerg', 'ignproleague', 'playhemtv', 'TheBrett');

$allowed_types = array('channel', 'chat');

$channel = isset($_GET['channel']) && in_array($_GET['channel'], $allowed_channels) ? $_GET['channel'] : null ;
$type = isset($_GET['type']) && in_array($_GET['type'], $allowed_types) ? $_GET['type'] : 'channel' ;
$url = null;

if (empty($channel)) {
    exit;
}

$cache_dir = dirname(__FILE__) . '/cache/';
$cache_file = $cache_dir . md5($channel . $type) . '.cache';
$expires = 60 * 60 * 24; // 1 dia

if (!file_exists($cache_dir)) {
    if (!@mkdir($cache_dir, 0755)) {
        echo get_embed($channel, $type);
        exit;
    }
}

if (file_exists($cache_file) && (time() - $expires < filemtime($cache_file))) {
    echo file_get_contents($cache_file);
}else{
    $embed = get_embed($channel, $type);
    file_put_contents($cache_file, $embed);
    echo $embed;
}


function get_embed($channel, $type) {
    switch ($type) {
        case 'chat':
            $url = 'http://api.justin.tv/api/channel/chat_embed/' . $channel . '?width=300&height=500';
            break;
        default:
            $url = 'http://api.justin.tv/api/channel/embed/' . $channel . '?width=620&height=500';
            break;
    }

    $ch = curl_init();
    curl_setopt_array($ch,
        array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
            ));
    $embed = curl_exec($ch);
    curl_close($ch);

    return $embed;
}