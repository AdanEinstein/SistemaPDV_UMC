<?php
session_start();
require_once(__DIR__ . "/../controller/api/UsuarioApi.php");

$user = $_POST['user'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$conexao = new DAO();

if (empty($user)) {
    $_SESSION['resposta'] = 'Preencha o campo user!';
    header("Location: ../cadastroUser.php");
} elseif (empty($password)) {
    $_SESSION['resposta'] = 'Preencha o campo password!';
    header("Location: ../cadastroUser.php");
} elseif ($password != $confirmPassword) {
    $_SESSION['resposta'] = 'Senhas não correspondentes!';
    header("Location: ../cadastroUser.php");
} else {
    if (empty(UsuarioApi::getUserByLogin($user))) {
        if (UsuarioApi::postUser($user, $password)) {
            $_SESSION['resposta'] = 'Usuário cadastrado com sucesso!';
            header("Location: ../index.php");
        } else {
            $_SESSION['resposta'] = 'Erro de cadastro!';
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['resposta'] = 'Usuário já existe!';
        header("Location: ../index.php");
    }
}
