<?php
    session_start();
    ob_start();

    

    $userType = 0;

    if($_SESSION["nome"] == "Henrique" || $_SESSION["nome"] == "Leones"){
        $userType = "1";
        echo "<p id='userType' value='suporte'>moderador</p>";
    } else {
        $userType = "0";
        echo "<p id='userType' value='cliente'>cliente</p>";
    }

?>



<html>

    <head>
        <title>Lobby_2</title>
        <link rel="stylesheet" href="../scripts/script-meet.js">
    </head>

    <body>

        <div id="meet"></div>


        <script src='https://meet.jit.si/external_api.js'></script>

        <script>

            //userType = document.getElementById("userType");

            //console.log(userType);

            //userType = document.getElementById("userType").innerHTML+"";



            const domain = 'meet.jit.si';
            const options = {
                roomName: document.title,
                width: 700,
                height: 700,
                parentNode: document.querySelector('#meet'),
                lang: 'pt-br'
            };




            api = new JitsiMeetExternalAPI(domain, options);

            
            setInterval(statusSala, 1000);

            function statusSala(){
                let request = new XMLHttpRequest()
                request.open("GET", "http://192.168.0.183/lobby-reunioes/api_2/json_lobbys.php", false);
                request.setRequestHeader("Content-type", "application/json");
                request.send();
                
                var obj = JSON.parse(request.responseText);

                numSala = <?php if(isset($_SESSION['lobby'])){
                    echo $_SESSION['lobby'];
                }else{
                    echo "0";
                } ?>;

                if(obj[numSala-1]["sala"] == "0"){
                    window.location.href = "http://192.168.0.183/lobby-reunioes/cliente/cliente.php";
                }

                var userType = <?php echo $userType; ?>;

                /*
                if(obj["lobby_"+numSala]["status"] == "0" && userType == "0"){
                    window.location.href = "http://localhost/lobby-reunioes/cliente/cliente.php";
                }
                */
            }
            
        </script>

    </body>
</html>