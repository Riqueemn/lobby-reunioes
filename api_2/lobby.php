<?php

class Lobby {
    
    public static function LobbyStatus($db){
        $sql = "SELECT * FROM `lobbys`";

        $lobbys = [];

        $select = mysqli_query($db, $sql);

        for($linha = 0; $resultado = mysqli_fetch_assoc($select); $linha++){
            $lobbys[$linha]['id'] = $resultado['id'];
            $lobbys[$linha]['nome'] = $resultado['nome'];
            $lobbys[$linha]['status'] = $resultado['status'];
            $lobbys[$linha]['sala'] = $resultado['sala'];
            $lobbys[$linha]['link'] = $resultado['link'];
        }


        return json_encode($lobbys);
    }

    public static function lobbyStatusEspecifico($db, $nome){
        $sql = "SELECT * FROM `lobbys` WHERE nome='lobby_1'";

        $select = mysqli_query($db, $sql);


        echo json_encode($select);
    }

    public static function LiberarLobby($db, $nome){
        $sql = "UPDATE lobbys SET status='1' WHERE nome='$nome'";
        mysqli_query($db, $sql);

        //return json_encode($lobbys);
    }

    public static function LiberarLobby2($db){
        $sql = "SELECT * FROM `lobbys`";

        $lobbys = [];

        $select = mysqli_query($db, $sql);

        for($linha = 0; $resultado = mysqli_fetch_assoc($select); $linha++){
            $lobbys[$linha]['id'] = $resultado['id'];
            $lobbys[$linha]['nome'] = $resultado['nome'];
            $lobbys[$linha]['status'] = $resultado['status'];
            $lobbys[$linha]['sala'] = $resultado['sala'];
            $lobbys[$linha]['link'] = $resultado['link'];
        }


        for($i = 0; $i < sizeof($lobbys); $i++){
            if ($lobbys[$i]['status'] == "0"){
                $nome = $lobbys[$i]['nome'];
                $sql = "UPDATE lobbys SET status='1' WHERE nome='$nome'";
                mysqli_query($db, $sql);
                break;
            }
            
        }

        //return json_encode($lobbys);
    }


    public static function FecharLobby($db, $nome){
        $sql = "UPDATE lobbys SET status='0' WHERE nome='$nome'";
        mysqli_query($db, $sql);

        //return json_encode($lobbys);
    }

    public static function OcuparLobby($db, $nome){
               
        $sql = "UPDATE lobbys SET status='2' WHERE nome='$nome'";
        mysqli_query($db, $sql);
          
        //return json_encode($lobbys);
    }

    public static function LiberarSala($db, $nome){
        $sql = "UPDATE lobbys SET sala='1' WHERE nome='$nome'";
        mysqli_query($db, $sql);

        //return json_encode($lobbys);
    }

}


?>