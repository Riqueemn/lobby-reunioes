<?php

$json = file_get_contents("../data/users.json");
$obj = json_decode($json, true);

$user_1 = $obj['User_1'];
$user_2 = $obj['User_2'];
$user_3 = $obj['User_3'];
$user_4 = $obj['User_4'];

$arrayUsers = array($user_1, $user_2, $user_3, $user_4);


echo implode(",", $arrayUsers);




header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>