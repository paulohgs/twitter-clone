<?php
    require_once ('db.class.php');
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $password = md5($_POST['senha']);

    $usuario_existe = false;
    $email_existe = false;

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    //verificar se o usuario existe
    $sql = "SELECT * FROM usuarios where usuario = '$user'";
    if ($resultado_id = mysqli_query($link, $sql)) {
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if (isset($dados_usuario['usuario'])) {
            $usuario_existe = true;
        } else {
            echo 'Usuário não cadastrado, pode cadastrar ae!';
        }
    } else {
        echo 'Erro ao tentar localizar registro de usuário';
    }

    //verificar se o email ja existe
    $sql = "SELECT * FROM usuarios where email = '$email'";

    if ($resultado_id = mysqli_query($link, $sql)) {
        $dados_usuario = mysqli_fetch_array($resultado_id);
        if (isset($dados_usuario['email'])) {
            $email_existe = true;
        } else {
            echo 'Email não cadastrado, pode cadastrar ae!';
        }
    } else {
        echo 'Erro ao tentar localizar registro de email';
    }

    if ($usuario_existe || $email_existe) {
        $retorno_get = '';
        if ($usuario_existe) {
            $retorno_get .= 'erro_usuario=1&';
        }
        if ($email_existe) {
            $retorno_get .= 'erro_email=1&';
        }
        header('location: inscrevase.php?'.$retorno_get);
        die();
    }

    $sql = " INSERT INTO usuarios(usuario, email, senha) VALUES('$user','$email','$password') ";

    //executar as query
    if(mysqli_query($link, $sql)){
        header('Location: index.php');
    } else {
        echo 'Erro ao registrar o usuário!';
    }