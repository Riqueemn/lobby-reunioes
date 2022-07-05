<?php

include("../api/conexao.php");
include("../api/lobby.php");

$lobbys = new Lobby();    

$obj = $lobbys->LobbyStatus($mysqli);

echo $obj;


?>