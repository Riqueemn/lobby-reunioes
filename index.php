<?php

$json = file_get_contents('php://input');
$obj = json_decode($json, true);


$pEstado = $obj['botao'];

echo $pEstado;




header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>