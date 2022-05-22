<?php
session_start();
require_once(__DIR__."/api/ProdutoApi.php");
$id = $_POST['id'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];

if (empty($descricao)) {
    $_SESSION['resposta'] = 'Descrição inválida!';
    header("Location: ../alterarProduto.php?id=" . $id);
} elseif (empty($preco) || $preco <= 0) {
    $_SESSION['resposta'] = 'Preço inválido!';
    header("Location: ../alterarProduto.php?id=" . $id);
} elseif (empty($quantidade) || $quantidade <= 0) {
    $_SESSION['resposta'] = 'Quantidade inválida!';
    header("Location: ../alterarProduto.php?id=" . $id);
} else {
    if (empty(ProdutoApi::descricaoExists($descricao, $id))) {
        if (ProdutoApi::putProduto($id, $descricao, $preco, $quantidade)) {
            $_SESSION['resposta'] = 'Produto atualizado com sucesso!';
            header("Location: ../listaDeProdutos.php");
        } else {
            $_SESSION['resposta'] = 'Há algum valor inválido!';
            header("Location: ../alterarProduto.php?id=" . $id);
        }
    } else {
        $_SESSION['resposta'] = 'Descriçao pertence a outro produto!';
        header("Location: ../alterarProduto.php?id=" . $id);
    }
}