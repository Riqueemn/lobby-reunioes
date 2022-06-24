<?php

error_reporting(0);
//ini_set(“display_errors”, 0 );

$json = file_get_contents("../data/data.json");
$obj = json_decode($json, true);

$lobby_1 = $obj['lobby_1'];
$lobby_2 = $obj['lobby_2'];
$lobby_3 = $obj['lobby_3'];
$lobby_4 = $obj['lobby_4'];

$lobbys = [];

for($k=0; $k<4;$k++){
    $lobbys[$k]['link'] = $obj['lobby_'.$k+1]['link'];
    $lobbys[$k]['status'] = $obj['lobby_'.$k+1]['status'];

}

$array = array($lobby_1, $lobby_2, $lobby_3, $lobby_4);

echo json_encode($obj);





header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>