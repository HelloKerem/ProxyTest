<?php
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Expires: 0');
$assetId = isset($_GET['assetId']) ? $_GET['assetId'] : 0;

if (!isset($_GET['assetId']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['assetId'])) {
    die(file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}"));
}

// Use fopen() on the remote file
$handle = @fopen("https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}", 'rb');
if (!$handle) {
    http_response_code(404);
    die("Asset not found or remote fetch failed.");
}

// Set headers for download
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"{$assetId}\"");

// Stream file to client
while (!feof($handle)) {
    echo fread($handle, 8192);
    flush();
}
fclose($handle);
exit;
