<?php

$json = file_get_contents("../data/data.json");
$obj = json_decode($json, true);

$lobby_1 = $obj['Lobby_1'];
$lobby_2 = $obj['Lobby_2'];
$lobby_3 = $obj['Lobby_3'];
$lobby_4 = $obj['Lobby_4'];

$arrayButtons = array($lobby_1, $lobby_2, $lobby_3, $lobby_4);


echo implode(",", $arrayButtons);




header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>