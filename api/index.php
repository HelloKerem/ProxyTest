<?php
header('Pragma: no-cache');
if(!isset($_GET['id'])){
http_response_code(404);
die("No assetId supplied."); // dont need to make errors pretty
}
$assetId = (int)$_GET['id'];
if($assetId === 0){
http_response_code(404);
die("No assetId supplied."); // dont need to make errors pretty
}
$stmt1 = $conn->prepare("SELECT * FROM assets WHERE id = :assetId");
$stmt1->bindParam(':assetId', $assetId);
$stmt1->execute();
$AssetOBJ = $stmt1->fetch(PDO::FETCH_ASSOC);
if(!$AssetOBJ){
http_response_code(404);
die("Asset does not exist."); // dont need to make errors pretty
}
header("Content-Type: application/octet-stream");
$ok = @file_get_contents("http://rblprox.servehttp.com:81/fetchasset.php?assetId={$assetId}");
if ($ok === false) {
    die(@file_get_contents("https://gitgud.io/nina11/my-guegue-project/-/raw/master/Assets/{$assetId}"));
} {
    die($ok);
}
?>
