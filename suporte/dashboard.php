<?php
    include("../api_2/conexao.php");
    include("../api_2/sessao.php");
    //include("../api_2/lobby.php");



    session_start();
    ob_start();

    $sessao = new Sessao();

    $lobbys = new Lobby();

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    var_dump($dados["lobby"]);
    if($dados["lobby"] != null){
        echo $dados["lobby"];
        //echo $_SESSION['lobby'];
        echo $lobbys->lobbyStatusEspecifico($mysqli, $dados["lobby"]);
        
        
        //header("Location: loading.php");
    }


    $aux_sala = $_SESSION['SalaPresente'];

    unset($_SESSION['SalaPresente']);

    $json = file_get_contents("../data/data.json");
    $obj = json_decode($json, true);

    if(!isset($_SESSION['nome'])){
        $_SESSION['msg'] = "<p style='color: #ff0000'>Necessário realizar o login para acessar a página</p>";
        header("Location: login.php");
    }
    if(!isset($_SESSION['SalaPresente'])){
        $obj["lobby_".$aux_sala]["sala"]="0";
        echo $aux_sala;

        $json = json_encode($obj);
        $bytes = file_put_contents("../data/data.json", $json);
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
                request.open("GET", "http://localhost/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var obj = JSON.parse(request.responseText);

                not = document.getElementById("form-not");

                not.innerHTML = "";
                for(i=0;i<4;i++){
                    if(obj[i]["status"]=="2"){
                        //notification = "<a href="+obj["lobby_"+(i+1)]["link"]+" value=lobby_"+(i+1);
                        notification = "<input type='submit' name='lobby' id='lobby-1' target='_blank' value='lobby_"+(i+1)+"'";
                        notification += " style='width:50px;height:50px; float:left;background:blue;margin:5px'>";
                        not.innerHTML += notification;
                    }   
                }
            }

            
        </script>

    </body>

</html>