<?php
header("Content-Type: application/octet-stream");
if(!isset($_GET['id'])){
    http_response_code(404);
    die("No assetId supplied."); // dont need to make errors pretty
}
$assetId = (int)$_GET['id'];
if($assetId === 0){
    $ch = curl_init("https://file.garden/aNTqSg4ZkRNIiewL/Assets/{$_GET['id']}");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 10,
    ]);
    $data = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    if ($code !== 200 || $data === false) {
        http_response_code(404);
        die("No assetId supplied.");
    }
    echo $data;
    exit;
}
$main = @file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}");
if ($main === false) {
    http_response_code(200);
    die("Asset does not exist.");
}
die($main);
?>
