<?php
session_start();
require_once '../banco/conexBanco.php';
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];

if (empty($descricao)) {
    $_SESSION['resposta'] = 'Preencha o campo descrição!';
    header("Location: ../cadastroProduto.php");
} elseif (empty($preco) || $preco <= 0) {
    $_SESSION['resposta'] = 'Preço inválido!';
    header("Location: ../cadastroProduto.php");
} elseif (empty($quantidade) || $quantidade <= 0) {
    $_SESSION['resposta'] = 'Quantidade inválida!';
    header("Location: ../cadastroProduto.php");
} else {
    $sql = "INSERT INTO produtos VALUES (DEFAULT, :descricao, :preco, :quantidade)";
    $formatarQuantidade = str_replace(",", ".", $quantidade);
    $formatarPreco = str_replace(",", ".", $preco);
    $params = [":descricao"=>$descricao, ":preco"=>$formatarPreco, ":quantidade"=>$formatarQuantidade];
    $conexao = new DAO();
    if ($conexao->executeSQL($sql, $params)) {
        $_SESSION['resposta'] = 'Produto cadastrado com sucesso!';
        header("Location: ../listaDeProdutos.php");
    }
}