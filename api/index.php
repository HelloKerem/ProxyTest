<?php
// i give up, so chatgpt:

header("Content-Type: application/octet-stream");

// Set default assetId
$assetId = isset($_GET['assetId']) ? $_GET['assetId'] : 1;

// Validate assetId
if (!isset($_GET['assetId']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['assetId'])) {
    // Fallback fetch
    $fallback = @file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}");
    if ($fallback === false) {
        http_response_code(404);
        die("Asset not found");
    }
    die($fallback);
}

// Open remote file
$handle = @fopen("https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}", 'rb');
if (!$handle) {
    http_response_code(404);
    die("Asset not found");
}

// Stream file in chunks
while (!feof($handle)) {
    echo fread($handle, 8192);
    flush();
}
fclose($handle);
exit;
