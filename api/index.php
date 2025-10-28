<?php
header('Pragma: no-cache');
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
    die($someserver);
}
$handle = @fopen("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}", 'rb');
die($handle);
if ($handle) {
    header("Content-Type: application/octet-stream");
    while (!feof($handle)) {
        echo fread($handle, 8192);
        flush();
    }
    fclose($handle);
    exit;
} else {
    http_response_code(404);
    die("Asset does not exist.");
}
?>
