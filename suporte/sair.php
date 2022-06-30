<?php

    include("../api_2/conexao.php");
    include("../api_2/sessao.php");
    include("../api_2/lobby.php");



    session_start();
    ob_start();

    $lobby = new Lobby();
    $sessao = new Sessao();


    $sessao->Deslogar($mysqli, $_SESSION['nome'], $lobby);


    unset($_SESSION['nome']);
    $_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso</p>";

    header("Location: login.php");

?>