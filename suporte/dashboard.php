<?php
    session_start();
    ob_start();

    $aux_sala = $_SESSION['SalaPresente'];

    unset($_SESSION['SalaPresente']);

    $json = file_get_contents("../data/users.json");
    $users = json_decode($json, true);

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

    

    for($i=0; $i<sizeof($users); $i++){
        //echo $users[strval(1)]["nome"];
        if($_SESSION['nome'] == $users[strval($i)]["nome"]){
            $users[strval($i)]["status"] = 1;
        }
    }

    $json = json_encode($users);
    $bytes = file_put_contents("../data/users.json", $json);

    

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

        </div>

        <a href="sair.php">Sair</a>

        <script>
            

            setInterval(notification, 1000);

            function redirectSala(obj, numSala){
                obj["lobby_"+(numSala)].sala = 1+"";
                liberarSala(obj)
                window.location.href = obj["lobby_"+numSala]["link"];
            }


            function notification(){
                var response = getLobbys();
                obj = JSON.parse(response);
                //console.log(obj);

                not = document.getElementById("not");

                not.innerHTML = "";
                for(i=0;i<4;i++){
                    if(obj["lobby_"+(i+1)]["status"]=="1" || obj["lobby_"+(i+1)]["status"]=="2"){
                        //notification = "<a href="+obj["lobby_"+(i+1)]["link"]+" value=lobby_"+(i+1);
                        notification = "<a onclick='redirectSala(obj,"+(i+1)+");' value=lobby_"+(i+1);
                        notification += " style='width:50px;height:50px; float:left;background:blue;margin:5px'></a>";
                        not.innerHTML += notification;
                    }   
                }
            }

            
        </script>

    </body>

</html>