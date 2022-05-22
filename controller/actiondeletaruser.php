<?php
session_start();
require_once(__DIR__."/api/UsuarioApi.php");
$id = $_POST['id'];

if (UsuarioApi::deleteUser($id)) {
    $_SESSION['resposta'] = 'Usuário deletado com sucesso!';
} else {
    $_SESSION['resposta'] = 'Não foi possível deletar este usuário!';
}
header("Location: ../listaUsers.php");
