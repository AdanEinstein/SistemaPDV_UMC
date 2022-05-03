<?php
session_start();
require_once '../banco/conexBanco.php';
$id = $_POST['id'];

$sql = "DELETE FROM pdv_produtos WHERE id = :id";
$params = [":id"=>$id];
$conexao = new DAO();
if ($conexao->executeSQL($sql, $params)) {
    $_SESSION['resposta'] = 'Produto deletado com sucesso!';
    header("Location: ../listaDeProdutos.php");
}
