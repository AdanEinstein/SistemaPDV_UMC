<?php
session_start();
require_once(__DIR__."/api/ProdutoApi.php");
$id = $_POST['id'];

if (ProdutoApi::deleteProduto($id)) {
    $_SESSION['resposta'] = 'Produto deletado com sucesso!';
    header("Location: ../listaDeProdutos.php");
} else {
    $_SESSION['resposta'] = 'Não foi possível deletar este produto!';
    header("Location: ../listaDeProdutos.php");
}
