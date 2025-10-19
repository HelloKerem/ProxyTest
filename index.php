?php
function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}
ob_start();
$id = (string)$_GET["id"]; // parse id as string to bypass integer limit
header("Content-Type: application/octet-stream");
die($id);
?>
