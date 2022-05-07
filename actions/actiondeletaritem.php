<?php
session_start();
require "../banco/conexBanco.php";
$conexao = new DAO();

$id_venda = $_POST["idvenda"];
$id_produto = $_POST["id"];

$sql = "DELETE FROM pdv_vendas WHERE id_venda = :idvenda AND id_produto = :idproduto";
$params = [":idvenda"=>$id_venda, ":idproduto"=>$id_produto];

if($conexao->executeSQL($sql, $params)){
    $_SESSION["resposta"] = "Produto excluído!";
    header("Location: ../venderProdutos.php");
} else {
    $_SESSION["resposta"] = "Erro de exclusão do produto!";
    header("Location: ../venderProdutos.php");
}