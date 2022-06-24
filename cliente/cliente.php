<?php



    //unset($_SESSION['lobby']);
    session_start();
    ob_start();

    $json = file_get_contents("../data/data.json");
    $obj = json_decode($json, true);

    echo $_SESSION['lobby'];

    if(isset($_SESSION['lobby'])){
        $json = file_get_contents("../data/data.json");
        $obj = json_decode($json, true);

        $obj["lobby_".$_SESSION['lobby']]["status"] = "0";

        $json = json_encode($obj);
        $bytes = file_put_contents("../data/data.json", $json);
    }

    unset($_SESSION['lobby']);





    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados["lobby"]);

    if($dados["lobby"] != null){
        $_SESSION['lobby'] = $dados["lobby"][6];
        //echo $_SESSION['lobby'];

        
        
        header("Location: loading.php");
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
        
        <div class="lobby" >
            <form method="POST" action="">
                <input type="submit" name="lobby" id="lobby-1" class="buttons" target="_blank" value="lobby_1">
                <input type="submit"  name="lobby" id="lobby-2" class="buttons" target="_blank" value="lobby_2">
                <input type="submit" name="lobby" id="lobby-3" class="buttons" target="_blank" value="lobby_3">
                <input type="submit" name="lobby" id="lobby-4" class="buttons" target="_blank" value="lobby_4">
            </form>
        </div>

        <script src='../scripts/script-meet.js'></script>

        <script>


            

            setInterval(statusButtons, 1000);
            function statusButtons(){
                var response = getUsers();
                //var responseData = response.split(",");
                var response_2 = getLobbys();
                obj = JSON.parse(response_2);

                cont = parseInt(response);
               

                k = parseInt(response);
                //console.log(k);

                ///////  Disponível /////////////

                for(i=0; i<k; i++){
                    if(obj["lobby_"+(i+1)]["status"] =="2" || obj["lobby_"+(i+1)]["status"] =="3"){
                        document.getElementById("lobby-1").style.background = "#95a5a6";
                        document.getElementById("lobby-1").removeAttribute("href");
                        document.getElementById("lobby-"+(i+1)).setAttribute("disabled", "");
                        document.getElementById("lobby-1").innerHTML = "Indisponível";
                    }else{
                        document.getElementById("lobby-"+(i+1)).style.background = "#ffbe76";
                        document.getElementById("lobby-"+(i+1)).setAttribute("href", "http://localhost/lobby-reunioes/cliente/loading.php?"+(i+1));
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Disponível";
                    }
                }



                ///////  Ocupado /////////////


                for(i=k; i<4; i++){
                    if(obj["lobby_"+(i+1)]["status"] == "2"){
                        document.getElementById("lobby-1").style.background = "#95a5a6";
                        document.getElementById("lobby-1").removeAttribute("href");
                        document.getElementById("lobby-"+(i+1)).setAttribute("disabled", "");
                        document.getElementById("lobby-1").innerHTML = "Indisponível";
                    }else{
                        document.getElementById("lobby-"+(i+1)).style.background = "#e74c3c";
                        document.getElementById("lobby-"+(i+1)).removeAttribute("href");
                        document.getElementById("lobby-"+(i+1)).setAttribute("disabled", "");
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Ocupado";
                    }
                }

                


                /*

                     for(i=0; i<4; i++){
                    if(obj["lobby_"+(i+1)]["status"] =="1"){
                        document.getElementById("lobby-"+(i+1)).style.background = "#ffbe76";
                        document.getElementById("lobby-"+(i+1)).setAttribute("href", "http://localhost/lobby-reunioes/cliente/loading.php?"+(i+1));
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Disponível";
                    } else if(obj["lobby_"+(i+1)]["status"]=="0"){
                        document.getElementById("lobby-"+(i+1)).style.background = "#e74c3c";
                        document.getElementById("lobby-"+(i+1)).removeAttribute("href");
                        document.getElementById("lobby-"+(i+1)).innerHTML = "Ocupado";
                    } else if(obj["lobby_"+(i+1)]["status"]=="2"){
                        document.getElementById("lobby-1").style.background = "#95a5a6";
                        document.getElementById("lobby-1").removeAttribute("href");
                        document.getElementById("lobby-1").innerHTML = "Indisponível";
                    }

                }
                */

/*

                //////////////////////////////////////////////////

                ///////  Indisponível /////////////

                if(responseData[0] == "Indisponivel"){
                    document.getElementById("lobby-1").style.background = "#95a5a6";
                    document.getElementById("lobby-1").removeAttribute("href");
                    document.getElementById("lobby-1").innerHTML = "Indisponível";
                }

                if(responseData[1] == "Indisponivel"){
                    document.getElementById("lobby-2").style.background = "#95a5a6";
                    document.getElementById("lobby-2").removeAttribute("href");
                    document.getElementById("lobby-2").innerHTML = "Indisponível";
                }

                if(responseData[2] == "Indisponivel"){
                    document.getElementById("lobby-3").style.background = "#95a5a6";
                    document.getElementById("lobby-3").removeAttribute("href");
                    document.getElementById("lobby-3").innerHTML = "Indisponível";
                }

                if(responseData[3] == "Indisponivel"){
                    document.getElementById("lobby-4").style.background = "#95a5a6";
                    document.getElementById("lobby-4").removeAttribute("href");
                    document.getElementById("lobby-4").innerHTML = "Indisponível";
                }

                //////////////////////////////////////////////////

                            */

            }

            
        </script>

    </body>
</html>