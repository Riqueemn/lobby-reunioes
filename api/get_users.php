<?php

$json = file_get_contents("../data/users.json");
$users = json_decode($json, true);



function qtdUsersLogados($users){
    $cont = 0;
    
    for($i=0; $i<sizeof($users); $i++){
        //echo $users[strval(1)]["nome"];
        if($users[strval($i)]["status"] == "1"){
            $cont++;
        }
    }
   // echo $cont;
    return $cont;
}

$qtd = qtdUsersLogados($users);

echo $qtd;




header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Content-Type: application/json; charset=UTF-8");

?>