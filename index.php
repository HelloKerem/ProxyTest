<?php
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Expires: 0');

if (!isset($_GET['assetId']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['assetId'])) {
    http_response_code(404);
    die("No valid assetId supplied.");
}

$assetId = $_GET['assetId']; // keep it as string
$assetUrl = "https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}";

$assetcontent = @file_get_contents($assetUrl);
if ($assetcontent === false) {
    http_response_code(404);
    die("Asset not found.");
}

header("Content-Type: application/octet-stream");
echo $assetcontent;
exit;
