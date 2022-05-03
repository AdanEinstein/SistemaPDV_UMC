<?php
session_start();
require_once '../banco/conexBanco.php';
$id = $_POST['id'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];

if (empty($descricao)) {
    $_SESSION['resposta'] = 'Descrição inválida!';
    header("Location: ../alterarProduto.php?id=".$id);
} elseif (empty($preco) || $preco <= 0) {
    $_SESSION['resposta'] = 'Preço inválido!';
    header("Location: ../alterarProduto.php?id=".$id);
} elseif (empty($quantidade) || $quantidade <= 0) {
    $_SESSION['resposta'] = 'Quantidade inválida!';
    header("Location: ../alterarProduto.php?id=".$id);
} else {
    $sql = "UPDATE pdv_produtos SET descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id";
    $formatarQuantidade = str_replace(",", ".", $quantidade);
    $formatarPreco = str_replace(",", ".", $preco);
    $params = [":descricao"=>$descricao, ":preco"=>$formatarPreco, ":quantidade"=>$formatarQuantidade, ":id"=>$id];
    $conexao = new DAO();
    if ($conexao->executeSQL($sql, $params)) {
        $_SESSION['resposta'] = 'Produto atualizado com sucesso!';
        header("Location: ../listaDeProdutos.php");
    }
}