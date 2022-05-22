<?php
session_start();
require_once(__DIR__."/../controller/api/UsuarioApi.php");
$id = $_POST['id'];
$perfil = $_POST['perfil'];

if (empty($_POST["login"])) {
    $_SESSION['resposta'] = 'Login inválida!';
    header("Location: ../alterarUser.php?id=" . $id);
} elseif (empty($_POST["perfil"])) {
    $_SESSION['resposta'] = 'O perfil não foi selecionado!';
    header("Location: ../alterarUser.php?id=" . $id);
} else {
    if(UsuarioApi::putUserPerfil($id, $perfil)){
        $_SESSION['resposta'] = 'Usuario atualizado com sucesso!';
    } else {
        $_SESSION['resposta'] = 'Erro de atualização!';
    }
    header("Location: ../listaUsers.php");
}