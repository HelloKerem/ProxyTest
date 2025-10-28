<?php
header("Content-Type: application/octet-stream");
$assetId = isset($_GET['assetId']) ? $_GET['assetId'] : 1;
if (!isset($_GET['assetId']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['assetId'])) {
    die(@file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}"));
}
$handle = @fopen("https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}", 'rb');
while (!feof($handle)) {
    echo fread($handle, 8192);
    flush();
}
fclose($handle);
exit;
