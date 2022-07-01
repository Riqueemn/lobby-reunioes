<?php



?>


<!DOCTYPE html>
<html>

    <head>
        <title>Cliente</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        
        <div id="lobby" >
            <button onClick="redirectLoading('lobby_1')" name="lobby" id="lobby-1" class="buttons" value="lobby_1"></button>
            <button onClick="redirectLoading('lobby_2')" name="lobby" id="lobby-2" class="buttons" value="lobby_2"></button>
            <button onClick="redirectLoading('lobby_3')" name="lobby" id="lobby-3" class="buttons" value="lobby_3"></button>
            <button onClick="redirectLoading('lobby_4')" name="lobby" id="lobby-4" class="buttons" value="lobby_4"></button>
        </div>

        <div class="loading">

        </div>

        <script>

            var name = "";
            function redirectLoading(nomeLobby){
                name = nomeLobby;
                var node = document.getElementById("lobby");
                if (node.parentNode) {
                    node.parentNode.removeChild(node);
                }

                var ifrm = document.createElement("iframe");
                ifrm.setAttribute("src", "http://192.168.0.183/lobby-reunioes/cliente/loading.php");
                ifrm.setAttribute("height", "800");
                ifrm.setAttribute("width", "800");
                document.getElementsByClassName("loading")[0].appendChild(ifrm);

                let myPromise = new Promise(function(myResolve, myReject) {
                    let socket = new WebSocket('ws://localhost:9990/meet');
                    let intervalConnectionSocket = setInterval(() =>{
                        if(socket["readyState"] == 1){
                            myResolve(socket);
                            clearInterval(intervalConnectionSocket);
                        }
                    }, 100);                    
                });

                var data = {
                    nome: nomeLobby,
                    userType: "0"
                };

                myPromise.then(
                    function(value) {value.send(JSON.stringify(data));},
                );
            }
            

            setInterval(statusButtons, 1000);
            function statusButtons(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://192.168.0.183/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var response = JSON.parse(request.responseText);

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