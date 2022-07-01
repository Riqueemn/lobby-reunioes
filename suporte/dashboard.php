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
    </head>

    <body>

        <h1>Bem Vindo <?php echo $_SESSION['nome'] ?></h1>

        <div id="not">
            
        </div>

        <div class="meetView">

        </div>

        <a href="sair.php">Sair</a>

        <script>

            var name = "";
            var obj;

            const nome = "<?php echo $_SESSION['nome'] ?>";
            
            var con;
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
                    nome: nome,
                    userType: "1"
                };

                myPromise.then(
                    function(value) {
                        value.send(JSON.stringify(data));
                        con = value;
                    },
                );

            setInterval(notification, 1000);

            function redirectSala(i){
                //window.location.href = obj[numSala]["link"];
                console.log(obj[i]);
                

                var ifrm = document.createElement("iframe");
                ifrm.setAttribute("src", obj[i]["link"]);
                ifrm.setAttribute("height", "800");
                ifrm.setAttribute("width", "800");
                document.getElementsByClassName("meetView")[0].appendChild(ifrm);

                var data = {
                    nome: obj[i]["nome"],
                    cmd: "ls"
                };

                
                con.send(JSON.stringify(data));
                
                
            }


            function notification(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://192.168.0.183/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                obj = JSON.parse(request.responseText);

                not = document.getElementById("not");

                not.innerHTML = "";
                for(i=0;i<4;i++){
                    if(obj[i]["status"] == "2" && obj[i]["sala"] == "0"){
                        //notification = "<a href="+obj["lobby_"+(i+1)]["link"]+" value=lobby_"+(i+1);
                        notification = "<button onClick='redirectSala("+i+")'";
                        notification += " style='width:100px;height:50px; float:left;background:#27ae60;margin:5px'></button>";
                        not.innerHTML += notification;
                    }   
                }
            }

            
        </script>

    </body>

</html>