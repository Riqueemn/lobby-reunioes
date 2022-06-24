<?php
    session_start();
    ob_start();

    $_SESSION["SalaPresente"]= 1;

    $json = file_get_contents("../data/data.json");
    $obj = json_decode($json, true);

    $obj["lobby_".$_SESSION["SalaPresente"]]["status"]="3";

    $json = json_encode($obj);
    $bytes = file_put_contents("../data/data.json", $json);

    $userType = 0;

   if($_SESSION["nome"] == "Henrique" || $_SESSION["nome"] == "Leones"){
    $userType = "1";
    echo "<p id='userType' value='suporte'>suporte</p>";
   } else {
    $userType = "0";
    echo "<p id='userType' value='cliente'>cliente</p>";
   }

?>


<html>

    <head>
        <title>Lobby_1</title>
        <link rel="stylesheet" href="../scripts/script-meet.js">
    </head>

    <body>

        <div id="meet"></div>


        <script src='https://meet.jit.si/external_api.js'></script>
        <script src='../scripts/script-meet.js'></script>

        <script>

            
userType = document.getElementById("userType");

            console.log(userType);

            setInterval(statusSala, 1000);

            function statusSala(){
                var response = getLobbys();
                obj = JSON.parse(response);

                numSala = <?php echo $_SESSION['lobby']; ?>;

                if(obj["lobby_"+numSala]["sala"] == "0"){
                    window.location.href = "http://localhost/lobby-reunioes/cliente/cliente.php";
                }

                if(obj["lobby_"+numSala]["status"] == "0" && <?php echo $userType; ?> == "0"){
                    window.location.href = "http://localhost/lobby-reunioes/cliente/cliente.php";
                }
            }
        </script>

    </body>
</html>