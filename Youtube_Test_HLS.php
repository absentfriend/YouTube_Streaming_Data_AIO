<?php
// ESHTE BER ME TALL KARIN ME KETA JEVGJIT E YouTube
// JUST FOR FUNNY DUDE
error_reporting(0);
$id = $_GET["id"];
if(!$id) die("Need YouTube Live Stream Video ID Example: ?id=KjpZ7TeXoH4");
$html = file_get_contents("https://www.youtube.com/watch?v=$id");
$hlsManifestUrl = '/,\\\\"hlsManifestUrl\\\\":\\\\"(.*?)\\\\"/m';
preg_match_all($hlsManifestUrl, $html, $match, PREG_PATTERN_ORDER, 0);
    $stream = $match[1][0];
	$stream=str_replace("\/", "/", $stream);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
//header("Location: " .$stream, 302); // PER XT PANEL HAP KETTE LINE EDHE MBYLL 2 TE TJERAT QE JANE ME POSHTE
// echo $stream;      // << PRINT RAW CODE
readfile ($stream); // << READ HLS SOURCE DIRECT FROM BROWSER
?> 