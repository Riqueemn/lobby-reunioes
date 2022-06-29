<?php

    include("../api_2/conexao.php");
    include("../api_2/lobby.php");

    //unset($_SESSION['lobby']);
    session_start();
    ob_start();

    $lobbys = new Lobby();    

    $obj = $lobbys->LobbyStatus($mysqli);


    echo $_SESSION['lobby'];

    if(isset($_SESSION['lobby'])){
        $lobbys->LiberarLobby($mysqli, "lobby_".$_SESSION['lobby']);
    }

    unset($_SESSION['lobby']);





    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    var_dump($dados["lobby"]);
    if($dados["lobby"] != null){
        $_SESSION['lobby'] = $dados["lobby"][6];
        //echo $_SESSION['lobby'];

        
        
        header("Location: loading.php");
    }

?>


<!DOCTYPE html>
<html>

    <head>
        <title>Cliente</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        
        <div class="lobby" >
            <form method="POST" action="">
                <input type="submit" name="lobby" id="lobby-1" class="buttons" target="_blank" value="lobby_1">
                <input type="submit"  name="lobby" id="lobby-2" class="buttons" target="_blank" value="lobby_2">
                <input type="submit" name="lobby" id="lobby-3" class="buttons" target="_blank" value="lobby_3">
                <input type="submit" name="lobby" id="lobby-4" class="buttons" target="_blank" value="lobby_4">
            </form>
        </div>

        <script src='../scripts/script-meet.js'></script>

        <script>

            setInterval(statusButtons, 1000);
            function statusButtons(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://localhost/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var response = JSON.parse(request.responseText);

                for(i=0; i<4; i++){
                    if(response[i]["status"] == "0"){
                        document.getElementById("lobby-"+(i+1)).style.background = "#95a5a6";
                        document.getElementById("lobby-"+(i+1)).setAttribute("disabled", "");
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Indisponível";
                    } else if (response[i]["status"] == "2"){

                        document.getElementById("lobby-"+(i+1)).style.background = "#e74c3c";
                        document.getElementById("lobby-"+(i+1)).setAttribute("disabled", "");
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Ocupado";
                    } else if (response[i]["status"] == "1"){
                        document.getElementById("lobby-"+(i+1)).style.background = "#ffbe76";
                        //document.getElementById("lobby-"+(i+1)).setAttribute("disabled", "");
                        document.getElementById("lobby-"+(i+1)).setAttribute("href", "http://localhost/lobby-reunioes/cliente/loading.php");
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Disponível";
                    }
                }
            }
            
        </script>

    </body>
</html>