<?php


    session_start();
    ob_start();

  

    

    if(!isset($_SESSION['lobby'])){
        header("Location: cliente.php");
    }

    




 

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Cliente</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/styles.css">
        <script src='https://8x8.vc/external_api.js'></script>
    </head>

    <body>
        
        <h4 id="loading">Aguarde a liberação da sala...</h4>

        <div id="meet" />

        <script>

            var enderecoServerSocket = "10.85.7.216";
            var enderecoPlataforma = "10.85.7.216";

            var load = document.getElementById("loading");
            const nome = "<?php echo $_SESSION['lobby'] ?>";

            var roomName = '';
            var jwt = '';
            
            var con;
            let myPromise = new Promise(function(myResolve, myReject) {
                let socket = new WebSocket('ws://'+enderecoServerSocket+':9990/meet');
                
                socket.addEventListener('error', function (event) {
                    console.log('WebSocket error: ', event["target"]["readyState"]);

                    
                    if(event["target"]["readyState"] == 1){
                        console.log("Conectado com o Servidor");
                    }

                    if(event["target"]["readyState"] == 3){
                        console.log("Servidor Caiu");
                        window.location.href = "http://"+enderecoPlataforma+"/lobby-reunioes/cliente/cliente.php";
                    }

                    if(event["target"]["readyState"] == 2){
                        console.log("Servidor está em processo de fechamento");
                        window.location.href = "http://"+enderecoPlataforma+"/lobby-reunioes/cliente/cliente.php";
                    }
                });

                

                let intervalConnectionSocket = setInterval(() =>{
                if(socket["readyState"] == 1){
                    myResolve(socket);
                    clearInterval(intervalConnectionSocket);
                }
                }, 100);                    
            });

            var data = {
                nome: nome,
                userType: "cliente",
                lobby: nome,
                cmd: "0"
            };

            myPromise.then(
               function(value) {
                    value.send(JSON.stringify(data));
                    con = value;

                    con.addEventListener('message', function (event) {
                        const data = JSON.parse(event.data);
                        if(data[0] == "credenciais-cliente"){
                            console.log(data);
                            roomName = data[1];
                            jwt = data[2];

                            load.remove();

                            meet();
                        }else if(data[0] == "lobby-sair"){
                            console.log("Sem suporte para atender");
                            window.location.href = "http://"+enderecoPlataforma+"/lobby-reunioes/cliente/cliente.php";
                        }else{
                            console.log("Lobby que ficou indisponivel: " + data);
                        }

                    });
               },
            );


            function meet(){

                console.log(roomName);
                console.log(jwt);

                let api;
    
                
                
                    const domain = '8x8.vc';
                    const options = {
                    roomName: roomName,
                    jwt: jwt,
                    width: 700,
                    height: 700,
                    parentNode: document.querySelector('#meet')
                    };
                    api = new JitsiMeetExternalAPI(domain, options);
                
                
                
            }
            
            
        </script>

    </body>
</html>


<?php

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
?>