<?php

/*
 ┌────────────────────────────────────────────────────────────┐
 |  For More Modules Or Updates Stay Connected to Kodi dot AL |
 └────────────────────────────────────────────────────────────┘
 ┌───────────┬────────────────────────────────────────────────┐
 │ Product   │ YouTube HLS Stream Extractor by Channel Name   │
 │ Version   │ v1.0                                           │
 │ Provider  │ https://www.youtube.com/                       │
 │ Support   │ M3U8/VLC/KODI/SMART TV/Xream Codes Panel ETC   │
 │ Licence   │ MIT                                            │
 │ Author    │ Olsion Bakiaj                                  │
 │ Email     │ TRC4@USA.COM                                   │
 │ Author    │ Endrit Pano                                    │
 │ Email     │ INFO@ALBDROID.AL                               │
 │ Website   │ https://kodi.al                                │
 │ Facebook  │ /albdroid.official/                            │
 │ Created   │ Sunday, January 19, 2020                       │
 │ Modified  │ Tuesday, January 28, 2020                      │
 └────────────────────────────────────────────────────────────┘
 [x] To Get Live Stream Required Live Stream Video ID
 Formats
 96 = 1080P Full HD
 95 = 720P HD
 94 = 480P SD
 93 = 360P Low
*/

error_reporting(0);
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
$XTREAM_PANEL = $ROOT_URL . "xtream_panel.php?id=" . "2018HTdmB-4";
$RAW_STREAM = $ROOT_URL . "raw_stream.php?id=" . "2018HTdmB-4";
$M3U_STREAM = $ROOT_URL . "m3u_stream.php?id=" . "2018HTdmB-4";
$KODI_STUCTURE = $ROOT_URL . "kodi_stucture.php?id=" . "2018HTdmB-4";

if(!isset($_GET['id']))
die("<b>
<center>
<font color=lime><h2>YouTube Streaming</h2></b>
</center>
<center>
<font color=red><b>STRUKTURA!!!</b>
</center>
<br/>
<b>
<center>
<font color=lime>Platform: Smart TV VLC Kodi ETC</b>
</center>
</font>
<br/>
<body style='background-color:black'>
<b>
<center>
<font color=lime>?id={LIVE STREAM VIDEO ID}</b>
</center>
</font>
<br/>
<b>
<center>
<font color=lime>Pershembull:<br>
<font color=lime>XTREAM PANEL:<font color=red> $XTREAM_PANEL<br>
<font color=lime>M3U STREAM:<font color=red> $M3U_STREAM<br>
<font color=lime>RAW STREAM:<font color=red> $RAW_STREAM<br>
<font color=lime>KODI STREAM:<font color=red> $KODI_STUCTURE<br>
</b>
</center>
</font>
<br/>
<b>
<center>
<font color=lime>API: https://kodi.al/</b></center></font>
<br/>
<b><center><font color=lime>FB: /albdroid.official/</b></center></font><br/>
");
{
$chid = $_GET["id"];
date_default_timezone_set("Europe/Tirane");
function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36");
    curl_setopt($ch, CURLOPT_REFERER, "https://www.youtube.com/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$string = get_data('https://www.youtube.com/watch?v=' . $chid);
// AUTO MODE
$hlsManifestUrl = '/,\\\\"hlsManifestUrl\\\\":\\\\"(.*?)\\\\"/m';
preg_match_all($hlsManifestUrl, $string, $matches, PREG_PATTERN_ORDER, 0);
// AUTO MODE

// MANUAL MODE PUNON
//preg_match_all($hlsManifestUrl, $string, $matches, PREG_SET_ORDER, 0);
//preg_match_all('/,\\\\"hlsManifestUrl\\\\":\\\\"(.*?)\\\\"/m',$string,$matches, PREG_PATTERN_ORDER);
// MANUAL MODE PUNON

$var1=$matches[1][0];
//$var1 = substr($var1, 8);
$var1=str_replace("\/", "/", $var1);
$man = get_data($var1);
/*
 QUALITY SETTINGS
 96 = 1920x1080 
$regex = '/(https:\/.*\/96\/.*index.m3u8)/U';

 95 = 1280x720
$regex = '/(https:\/.*\/95\/.*index.m3u8)/U';

 94 = 854x480
$regex = '/(https:\/.*\/94\/.*index.m3u8)/U';

 94 = 854x480
$regex = '/(https:\/.*\/94\/.*index.m3u8)/U';

 93 = 640x360
$regex = '/(https:\/.*\/93\/.*index.m3u8)/U';
*/
preg_match_all('/(https:\/.*\/95\/.*index.m3u8)/U',$man,$matches, PREG_PATTERN_ORDER);
$stream_link=$matches[1][0];
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
echo "#EXTM3U\n";
echo "#EXTINF:-1,MY STREAM NAME\n";
echo $stream_link;
}
?>