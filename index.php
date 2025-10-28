<?php
header('Pragma: no-cache');
// this is used by the launcher webserver
if(!isset($_GET['assetId'])){
http_response_code(404);
die("No assetId supplied."); // dont need to make errors pretty
}
$assetId = (int)$_GET['assetId'];
if($assetId === 0){
http_response_code(404);
die("No assetId supplied."); // dont need to make errors pretty
}
header("Content-Type: application/octet-stream");
$assetUrl = "https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}";
$assetcontent = file_get_contents($assetUrl);
$fopenthing = fopen($assetcontent, 'r');
$assetcontent = stream_get_contents($fopenthing);
fclose($fopenthing);
die($assetcontent);
?>
