<?php

include("../api_2/lobby.php");


class Sessao {
    
    public static function Logar($db, $nome){
        $sql = "UPDATE users_suporte SET status='1' WHERE nome='$nome'";


        mysqli_query($db, $sql);

        echo "Logado";

        $lobbys = new Lobby();    
        $lobbys->LiberarLobby($db, "lobby_1");
    }

    public static function Deslogar($db, $nome){
        $sql = "SELECT * FROM `users_suporte` WHERE nome='$nome'";
        $sql = "UPDATE users_suporte SET status='0' WHERE nome='$nome'";


        mysqli_query($db, $sql);

        echo "Deslogado";

        $lobbys = new Lobby();    
        $lobbys->FecharLobby($db, "lobby_1");
    }

    public static function SuporteLogados($db){
        $sql = "SELECT * FROM `users_suporte`";

        $lobbys = [];

        $select = mysqli_query($db, $sql);

        $cont = 0;

        for($linha = 0; $resultado = mysqli_fetch_assoc($select); $linha++){
            
            if($lobbys[$linha]['status'] == "1"){
                $cont++;
            }
           
        }


        return $cont;
    }
}


?>