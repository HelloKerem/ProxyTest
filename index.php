<?php
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Expires: 0');

if (!isset($_GET['assetId']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['assetId'])) {
    http_response_code(404);
    die("No valid assetId supplied.");
}

$assetId = $_GET['assetId'];
$assetUrl = "https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}";

// Use fopen() on the remote file
$handle = @fopen($assetUrl, 'rb');
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
