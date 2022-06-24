<?php


    //unset($_SESSION['lobby']);
    session_start();
    ob_start();

  

    $json = file_get_contents("../data/data.json");
    $obj = json_decode($json, true);


    if(!isset($_SESSION['lobby'])){
        header("Location: cliente.php");
    }else{

        $obj["lobby_".$_SESSION['lobby']]["status"]="2";

        $json = json_encode($obj);
        $bytes = file_put_contents("../data/data.json", $json);


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
            setLobbyOnline(<?php echo $_SESSION['lobby']; ?>);

            setInterval(statusSala, 1000);

            function statusSala(){
                var response = getLobbys();
                obj = JSON.parse(response);

                numSala = <?php echo $_SESSION['lobby']; ?>;

                if(obj["lobby_"+numSala]["sala"] == "1"){
                    window.location.href = obj["lobby_"+numSala]["link"];
                } 
                
                if(obj["lobby_"+numSala]["status"] == "0"){
                    window.location.href = "http://localhost/lobby-reunioes/cliente/cliente.php";
                }
            }
            
        </script>

    </body>
</html>


<?php

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
//header("Content-Type: application/json; charset=UTF-8");
?>