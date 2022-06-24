<?php
session_start();
ob_start();

$json = file_get_contents("../data/users.json");
    $users = json_decode($json, true);

    for($i=0; $i<sizeof($users); $i++){
        //echo $users[strval(1)]["nome"];
        if($_SESSION['nome'] == $users[strval($i)]["nome"]){
            $users[strval($i)]["status"] = 0;
        }
    }

$json = json_encode($users);
$bytes = file_put_contents("../data/users.json", $json);


unset($_SESSION['nome']);
$_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso</p>";

header("Location: login.php");

?>