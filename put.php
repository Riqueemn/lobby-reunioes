<?php

$json = file_get_contents("php://input");
$bytes = file_put_contents("data.json", $json);

echo $bytes;



header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>