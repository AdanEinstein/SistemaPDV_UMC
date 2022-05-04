<?php
session_start();
require_once '../banco/conexBanco.php';
$email = $_POST['email'];
$newPassword = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if($password == $confirmPassword)
{
    $sql = "UPDATE pdv_usuarios SET :password WHERE :id =)";
    $params = [":password"=>$password, ":perfil"=>'padrão'];
    $conexao = new DAO();
    if ($conexao->executeSQL($sql, $params)) {
        $_SESSION['resposta'] = 'Recuperação de senha realizada com sucesso!';
        header("Location: ../index.php");
    }
}

?>