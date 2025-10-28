<?php
if(!isset($_GET['id'])){
    http_response_code(404);
    die("No assetId supplied."); // dont need to make errors pretty
}
$assetId = (int)$_GET['id'];
if($assetId === 0){
    $data = @file_get_contents("https://file.garden/aNTqSg4ZkRNIiewL/Assets/{$_GET['id']}");
    if ($data === false) {
        http_response_code(404);
        die("No assetId supplied.");
    }
    header("Location: https://file.garden/aNTqSg4ZkRNIiewL/Assets/{$_GET['id']}");
    exit;
}
header("Content-Type: application/octet-stream");
$main = @file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}");
if ($main === false) {
    http_response_code(200);
    die("Asset does not exist.");
}
die($main);
?>
