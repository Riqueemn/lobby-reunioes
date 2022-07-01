<?php

        
    include("../api_2/conexao.php");
    include("../api_2/lobby.php");


    //unset($_SESSION['lobby']);
    session_start();
    ob_start();

  

    
    echo $_SESSION['lobby'];

    if(!isset($_SESSION['lobby'])){
        //header("Location: cliente.php");
    }else{

        $lobbys = new Lobby();    

        //$obj = $lobbys->OcuparLobby($mysqli, "lobby_".$_SESSION['lobby']);

        echo $_SESSION['lobby'];
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
        
        <h4>Aguarde a liberação da sala...</h4>

        <script src='../scripts/script-meet.js'></script>

        <script>
            numLobby = document.URL[document.URL.length - 1];

            setInterval(statusSala, 1000);

            function statusSala(){
                console.log("bbbbb");
                let request = new XMLHttpRequest()
                request.open("GET", "http://192.168.0.183/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var obj = JSON.parse(request.responseText);

                numSala = 1;


                if(obj[numSala-1]["status"] == "0"){
                    window.location.href = "http://192.168.0.183/lobby-reunioes/cliente/cliente.php";
                }


                if(obj[numSala-1]["sala"] == "1"){
                    window.location.href = obj[numSala-1]["link"];
                } 
                
                /*
                if(obj[numSala-1]["status"] != "2"){
                    window.location.href = "http://localhost/lobby-reunioes/cliente/cliente.php";
                }
                */
 
            }
            
        </script>

    </body>
</html>


<?php

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
//header("Content-Type: application/json; charset=UTF-8");
?>