<?php
    include("../api_2/conexao.php");
    include("../api_2/sessao.php");
    include("../api_2/lobby.php");



    session_start();
    ob_start();

    $lobbys = new Lobby();

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    var_dump($dados["lobby"]);
    if($dados["lobby"] != null){
        echo $dados["lobby"];
        $lobbyInfo =  $lobbys->lobbyStatusEspecifico($mysqli, $dados["lobby"]);
        $lobbys->LiberarSala($mysqli, $dados["lobby"]);
        $_SESSION['sala'] = $lobbyInfo["nome"];
        
        header("Location: ".$lobbyInfo["link"]);
    } else {
        //echo $_SESSION['sala'];
        if($_SESSION['sala'] != null){
            $lobbys->FecharSala($mysqli, $_SESSION['sala']);
            $lobbys->LiberarLobby($mysqli, $_SESSION['sala']);
            unset($_SESSION['sala']);
        }
        
    }

    if(!isset($_SESSION['nome'])){
        $_SESSION['msg'] = "<p style='color: #ff0000'>Necessário realizar o login para acessar a página</p>";
        header("Location: login.php");
    }
    
    

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>

    <script src='../scripts/script-meet.js'></script>


        <h1>Bem Vindo <?php echo $_SESSION['nome'] ?></h1>

        <div id="not">
            <form id="form-not" method="POST" action="">  
            </form>
        </div>

        <a href="sair.php">Sair</a>

        <script>
            

            setInterval(notification, 1000);

            function redirectSala(obj, numSala){
                window.location.href = obj[numSala]["link"];
            }


            function notification(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://192.168.0.183/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var obj = JSON.parse(request.responseText);

                not = document.getElementById("form-not");

                not.innerHTML = "";
                for(i=0;i<4;i++){
                    if(obj[i]["status"] == "2" && obj[i]["sala"] == "0"){
                        //notification = "<a href="+obj["lobby_"+(i+1)]["link"]+" value=lobby_"+(i+1);
                        notification = "<input type='submit' name='lobby' id='lobby-1' target='_blank' value='lobby_"+(i+1)+"'";
                        notification += " style='width:100px;height:50px; float:left;background:#27ae60;margin:5px'>";
                        not.innerHTML += notification;
                    }   
                }
            }

            
        </script>

    </body>

</html>