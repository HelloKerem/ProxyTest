<?php
header("Content-Type: application/octet-stream");
if(!isset($_GET['id'])){
    http_response_code(404);
    die("No assetId supplied."); // dont need to make errors pretty
}
$assetId = (int)$_GET['id'];
if($assetId === 0){
    $someserver = @file_get_contents("https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$_GET['id']}");
    if ($someserver === false) {
        http_response_code(404);
        die("No assetId supplied.");
    }
    $something = @file_get_contents("https://file.garden/aNTqSg4ZkRNIiewL/Assets/{$_GET['id']}");
    if ($something === false) {
        http_response_code(404);
        die("No assetId supplied.");
    }
    die($something);
}
$main = @file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}");
if ($main === false) {
    http_response_code(404);
    die("Asset does not exist.");
}
die($main);
?>
