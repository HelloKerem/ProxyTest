<?php
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Expires: 0');
$assetId = isset($_GET['assetId']) ? $_GET['assetId'] : 0;
header("Content-Type: application/octet-stream");
if (!isset($_GET['assetId']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['assetId'])) {
    $handle = @fopen("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}", 'rb');
    while (!feof($handle)) {
        echo fread($handle, 8192);
        flush();
    }
    fclose($handle);
    exit;
}
$handle = @fopen("https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}", 'rb');
while (!feof($handle)) {
    echo fread($handle, 8192);
    flush();
}
fclose($handle);
exit;
