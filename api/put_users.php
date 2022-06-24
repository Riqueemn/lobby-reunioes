<?php

$json_1 = file_get_contents("php://input");
$numLobby = json_decode($json_1, true);

$json_2 = file_get_contents("../data/data.json");
$obj = json_decode($json_2, true);


$obj['lobby_'.$numLobby]['status'] = "2";


$json = json_encode($obj);
$bytes = file_put_contents("../data/data.json", $json);

echo $json;



header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>