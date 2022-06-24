<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>

        <?php
            //echo password_hash(1234, PASSWORD_DEFAULT)
        ?>

        <?php
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $json = file_get_contents("../data/users.json");
            $users = json_decode($json, true);

            function validarConta($users, $nome, $senha){
                for($i=0; $i<sizeof($users); $i++){
                    //echo $users[strval(1)]["nome"];
                    if($nome == $users[strval($i)]["nome"] AND $senha == $users[strval($i)]["senha"]){
                        return true;
                    }
                }

                return false;
            }

            

            if(!empty($dados['sendLogin'])){
                //var_dump($dados);
                $nome = $dados["usuario"];
                $senha = $dados["senha"];



                
                
                if(validarConta($users, $nome, $senha)){
                    $row_usuario = array("nome" => $nome, "senha" => $senha);
                    //var_dump($row_usuario);
                    $_SESSION['nome'] = $row_usuario['nome'];
                    header("Location: dashboard.php");
                } else{
                    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuario ou senha invalida</p>";
                }
            }

            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>

        <h1>Login</h1>

        <form method="POST" action="">
            <label>Usuario</label>
            <input type="text" name="usuario" placeholder="Digite o usuario"><br><br>

            <label>Senha</label>
            <input type="password" name="senha" placeholder="Digite sua senha"><br><br>

            <input type="submit" name="sendLogin" value="Entrar">


        </form>

    </body>

</html>