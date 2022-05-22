<?php
require_once(__DIR__.'/../controller/api/UsuarioApi.php');
session_start();

$login = $_POST["user"];
$senha = $_POST['password'];
if (empty($login)) {
    $_SESSION['resposta'] = "Preencha o campo USER!!!";
    header("Location: ../index.php");
} elseif (empty($senha)) {
    $_SESSION['resposta'] = "Preencha o campo PASSWORD!!!";
    header("Location: ../index.php");
} else {
    if($usuario = UsuarioApi::getUserByEmailPassword($login, $senha)){
        if ($usuario->getPerfil() == "adm") {
            $_SESSION['adm'] = $usuario;
            header("Location: ../home.php");
        } elseif ($usuario->getPerfil() == "padrão") {
            $_SESSION['usuario'] = $usuario;
            header("Location: ../home.php");
        } else {
            $_SESSION['resposta'] = "Aguarde aprovação do seu cadastro!";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['resposta'] = "Usuário inválido!!!";
        header("Location: ../index.php");
    }
}
