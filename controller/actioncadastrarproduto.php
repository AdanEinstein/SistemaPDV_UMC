<?php
session_start();
require_once(__DIR__."/api/ProdutoApi.php");
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
    if (empty(ProdutoApi::getProdutoByDecricao($descricao))) {
        if (ProdutoApi::postProduto($descricao, $preco, $quantidade)) {
            $_SESSION['resposta'] = 'Produto cadastrado com sucesso!';
            header("Location: ../listaDeProdutos.php");
        } else {
            $_SESSION['resposta'] = 'Há algum valor inválido!';
            header("Location: ../cadastroProduto.php");
        }
    } else {
        $_SESSION['resposta'] = 'Produto já existe!';
        header("Location: ../cadastroProduto.php");
    }
}