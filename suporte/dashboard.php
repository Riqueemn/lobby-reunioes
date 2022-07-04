<?php
    include("../api_2/conexao.php");
    include("../api_2/sessao.php");
    include("../api_2/lobby.php");



    session_start();
    ob_start();


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
        <script src='https://8x8.vc/external_api.js'></script>
    </head>

    <body>

        <h1>Bem Vindo <?php echo $_SESSION['nome'] ?></h1>

        <div id="not">
                   
        </div>

        <a href="sair.php">Sair</a>

        <div id="div-meet">
        </div>

        <script type="text/javascript">

            var htmlMeet = "<div id='meet' />";
            var divMeet = document.getElementById("div-meet");

            var not = document.getElementById("not");


            const nome = "<?php echo $_SESSION['nome'] ?>";
            
            var conn;
            
            var roomName = '';
            var jwt = '';
            var lobbyAtual = '';
            
            let myPromise = new Promise(function(myResolve, myReject) {
                    let socket = new WebSocket('ws://localhost:9990/meet');

                    socket.addEventListener('error', function (event) {
                    console.log('WebSocket error: ', event["target"]["readyState"]);

                    if(event["target"]["readyState"] == 1){
                        console.log("Conectado com o Servidor");
                    }else if(event["target"]["readyState"] == 0){
                        console.log("Conectando...");
                    }else if(event["target"]["readyState"] == 3){
                        console.log("Servidor Caiu");
                        window.location.href = "http://192.168.0.183/lobby-reunioes/suporte/login.php";
                    }else if(event["target"]["readyState"] == 2){
                        console.log("Servidor está em processo de fechamento");
                        window.location.href = "http://192.168.0.183/lobby-reunioes/suporte/login.php";
                    }
                    });

                    let intervalConnectionSocket = setInterval(() =>{
                        if(socket["readyState"] == 1){
                            console.log("Conectado com o Servidor");
                            myResolve(socket);
                            clearInterval(intervalConnectionSocket);
                        }
                    }, 100);       
                            
                });

            var data = {
                nome: nome,
                userType: "suporte",
                cmd: "0"
            };

            myPromise.then(
                    function(value) {
                    value.send(JSON.stringify(data));
                    conn = value;

                    conn.addEventListener('message', function (event) {
                        const data = JSON.parse(event.data);
                        if(data[0] == "credenciais-suporte"){
                            console.log(data);
                            roomName = data[1];
                            jwt = data[2];

                            not.setAttribute("hidden", "");

                            meet();
                        }else{
                            notification2(data);
                        }
                        
                    });
                },
            );

            

            //setInterval(notification, 1000);

            function notification2(data){
                not.innerHTML = "";
                console.log(data);
                for(i=0;i<data.length;i++){
                        notification = "<button id='"+data[i]+"' onClick=receberCredenciais('"+data[i]+"')";
                        notification += " style='width:100px;height:50px; float:left;background:#27ae60;margin:5px'>"+data[i]+"</button>";
                        not.innerHTML += notification;
                       
                }
            }


            function receberCredenciais(lobby){
                document.getElementById(lobby).setAttribute("disabled", "");
                
                var data = {
                    lobby: lobby,
                    cmd: "meet-suporte"
                };

                lobbyAtual = lobby;

                conn.send(JSON.stringify(data));

                console.log(roomName);
                console.log(jwt);


            }

            function meet(){

                divMeet.innerHTML += htmlMeet;

                let api;
                            
                const domain = '8x8.vc';
                const options = {
                roomName: roomName,
                jwt: jwt,
                width: 700,
                height: 700,
                parentNode: document.querySelector('#meet'),
                };
                api = new JitsiMeetExternalAPI(domain, options);

                var listener = function(event){
                    api.executeCommand('kickParticipant',"google-oauth2|106448277433076534193");
                    var data = {
                        lobby: lobbyAtual,
                        cmd: "sair-sala-suporte"
                    };

                    conn.send(JSON.stringify(data));

                    document.getElementById("meet").remove();
                    not.removeAttribute("hidden");

                    if(event.role === 'moderator'){
                        //api.executeCommand('closeBreakoutRoom', "vpaas-magic-cookie-e3d18e07c6b84703a43feca37bc14da3/lobby_1");

                        api.executeCommand('kickParticipant',"google-oauth2|106448277433076534193");
                    }
                    

                    //confirm("Moderador saiu");
                }
        
                //api.addListener("videoConferenceLeft", listener);
                api.addListener("videoConferenceLeft", () => {
                    api.executeCommand('closeBreakoutRoom', "vpaas-magic-cookie-e3d18e07c6b84703a43feca37bc14da3/lobby_1");
                    api.executeCommand('closeBreakoutRoom', "lobby_1");
                    api.executeCommand('kickParticipant',"google-oauth2|106448277433076534193");

                    document.getElementById("meet").remove();
                    not.removeAttribute("hidden");

                    var data = {
                        lobby: lobbyAtual,
                        cmd: "sair-sala-suporte"
                    };
                    conn.send(JSON.stringify(data));
                });

            }

            
        </script>

    </body>

</html>