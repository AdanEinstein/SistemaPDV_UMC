<?php
session_start();
require "../banco/conexBanco.php";
$conexao = new DAO();
if (empty($_GET["idproduto"])) {
    $_SESSION["resposta"] = "Por favor! Selecione algum produto";
    header("Location: ../venderProdutos.php");
} else {
    $id_venda = $_GET["idvenda"];
    $id_produto = $_GET["idproduto"];
    $consultaSQL = "SELECT * FROM pdv_vendas WHERE id_venda = '$id_venda' AND id_produto = '$id_produto'";
    $result = $conexao->select($consultaSQL, null, true);
    if ($result->rowCount() == 0) {
        $sql = "INSERT INTO pdv_vendas(id_venda, id_produto) VALUES (:idVenda, :idProduto)";
        $params = [":idVenda" => $id_venda, ":idProduto" => $id_produto];
        $conexao->executeSQL($sql, $params);
        $_SESSION["vendaid"] = $id_venda;
        header("Location: ../venderProdutos.php");
    } else {
        $_SESSION["resposta"] = "Produto já foi selecionado!";
        $_SESSION["vendaid"] = $id_venda;
        header("Location: ../venderProdutos.php");
    }
}
