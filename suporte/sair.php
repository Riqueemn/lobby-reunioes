<?php

    include("../api_2/conexao.php");
    include("../api_2/sessao.php");


    session_start();
    ob_start();

    $sessao = new Sessao();


    $sessao->Deslogar($mysqli, $_SESSION['nome']);


    unset($_SESSION['nome']);
    $_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso</p>";

    header("Location: login.php");

?>