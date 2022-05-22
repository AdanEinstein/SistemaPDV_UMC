<?php
require_once(__DIR__ . "/api/ProdutoApi.php");
require_once(__DIR__ . "/api/VendaApi.php");
session_start();

$id_venda = $_POST["idvenda"];
$id_produto = $_POST["id"];

$quantidadeRestante = (int)(ProdutoApi::getProdutoById($id_produto)->quantidade);

$quantidadeVendida = (int)(VendaApi::getVendaByIdVendaAndIdProduto($id_venda, $id_produto)->quantidade);

$quantidadeRestaurada = $quantidadeVendida + $quantidadeRestante;

if (ProdutoApi::putAtualizarEstoque($quantidadeRestaurada, $id_produto)) {

    if (VendaApi::deleteVenda($id_venda, $id_produto)) {
        $_SESSION["resposta"] = "Produto excluído!";
        header("Location: ../venderProdutos.php");
    } else {
        $_SESSION["resposta"] = "Erro de exclusão do produto!";
        header("Location: ../venderProdutos.php");
    }
};

