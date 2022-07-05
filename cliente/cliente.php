<?php

    include("../api/conexao.php");
    include("../api/lobby.php");

    session_start();
    ob_start();

    $lobbys = new Lobby();    
    

    unset($_SESSION['lobby']);





    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(!empty($dados["lobby"])){
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
                <button type="submit" name="lobby" disabled id="lobby-1" class="buttons" value="lobby_1">Indisponível</button>
                <button type="submit" name="lobby" disabled id="lobby-2" class="buttons" value="lobby_2">Indisponível</button>
                <button type="submit" name="lobby" disabled id="lobby-3" class="buttons" value="lobby_3">Indisponível</button>
                <button type="submit" name="lobby" disabled id="lobby-4" class="buttons" value="lobby_4">Indisponível</button>
            </form>
        </div>

        <script src='../scripts/script-meet.js'></script>

        <script>

            setInterval(statusButtons, 1000);
            function statusButtons(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://10.85.7.216/lobby-reunioes/api/json_lobbys.php", false);
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