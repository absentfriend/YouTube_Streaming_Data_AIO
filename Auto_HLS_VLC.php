<?php
/*
 ┌────────────────────────────────────────────────────────────┐
 |  For More Modules Or Updates Stay Connected to Kodi dot AL |
 └────────────────────────────────────────────────────────────┘
 ┌───────────┬────────────────────────────────────────────────┐
 │ Product   │ YouTube Live Stream Extractor                  │
 │ Version   │ v1.1                                           │
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
 │ Modified  │ Wednesday, March 4, 2020                       │
 └────────────────────────────────────────────────────────────┘
 [x] To Get Live Stream Required Live Stream Video ID
 Formats
 DO NOT NEED FORMAT, IT'S AUTOMATIC
 NOTE: IF YOU HAVE A PROBLEM WITH STREAM [GET] OPEN issues TO FIX IT
*/

error_reporting(0);
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
$Auto_HLS_VLC = $ROOT_URL . "Auto_HLS_VLC.php?id=" . "2018HTdmB-4";
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
<font color=lime>XTREAM PANEL:<font color=red> $Auto_HLS_VLC<br>
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

$chid = $_GET["id"];
$Get_Data_URL = (('http://youtube.com/get_video_info?video_id=' . $chid));
$Get_Data_Contents = urldecode(trim($Get_Data_URL));
$string_data = file_get_contents($Get_Data_Contents);
$decoded_data = urldecode($string_data);

// GET STREAM TITLE REGEX
preg_match('/"title":"(.*?)"/',$decoded_data,$title_matches);
$replace_title = str_replace(
    array("%20","\u0026","  "),
    array("", " ", ""),
    $title_matches[1]
);

// NOTE: TO REMOVE EMOJIS FROM TITLES JUST ADD SOME FUNCTION HERE

// GET STREAM HLS REGEX
preg_match('/"hlsManifestUrl":"(.*?)"/',$decoded_data,$m3u_matches);
$stream = $m3u_matches[1];
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
echo("#EXTM3U\n");
echo "#EXTINF:-1,$replace_title\n";
echo $stream;
?>