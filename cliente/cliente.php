<?php

    include("../api_2/conexao.php");
    include("../api_2/lobby.php");
    include("../api_2/sessao.php");

    session_start();
    ob_start();

    $sessao = new Sessao();
    $lobbys = new Lobby();    

    $nomeLobby = $_SESSION['lobby'];

    $obj = $lobbys->LobbyStatus($mysqli);
    $obj2 = $lobbys->lobbyStatusEspecifico($mysqli, $nomeLobby);
    $cont = $sessao->SuporteLogados($mysqli);

    if(isset($_SESSION['lobby']) && $obj2["sala"] != "1" && $cont != 0){
        //$lobbys->LiberarLobby($mysqli, "lobby_".$_SESSION['lobby']);
    }

    unset($_SESSION['lobby']);





    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados["lobby"]);
    if($dados["lobby"] != null){
        $l = $lobbys->lobbyStatusEspecifico($mysqli, $dados["lobby"]);
        if($l["status"] == "1"){
            $_SESSION['lobby'] = $dados["lobby"];
            header("Location: loading.php");
        }
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
                <button type="submit" name="lobby" id="lobby-1" class="buttons" value="lobby_1">Indisponível</button>
                <button type="submit" name="lobby" id="lobby-2" class="buttons" value="lobby_2">Indisponível</button>
                <button type="submit" name="lobby" id="lobby-3" class="buttons" value="lobby_3">Indisponível</button>
                <button type="submit" name="lobby" id="lobby-4" class="buttons" value="lobby_4">Indisponível</button>
            </form>
        </div>

        <script src='../scripts/script-meet.js'></script>

        <script>

            setInterval(statusButtons, 1000);
            function statusButtons(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://192.168.0.183/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var response = JSON.parse(request.responseText);

                console.log(response)

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
                        document.getElementById("lobby-"+(i+1)).removeAttribute("disabled");
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Disponível";
                    }
                }
            }
            
        </script>

    </body>
</html>