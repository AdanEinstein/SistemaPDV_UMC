<?php
require_once(__DIR__."/api/ProdutoApi.php");
require_once(__DIR__."/api/VendaApi.php");
session_start();
if (empty($_GET["idproduto"])) {
    $_SESSION["resposta"] = "Por favor! Selecione algum produto";
    header("Location: ../venderProdutos.php");
} elseif (empty($_GET["quant"])) {
    $_SESSION["resposta"] = "Por favor! Selecione a quantidade";
    header("Location: ../venderProdutos.php");
} else {
    $id_venda = $_GET["idvenda"];
    $id_produto = $_GET["idproduto"];
    $quant = $_GET["quant"];
    $quantidadeConsultada = (int) (ProdutoApi::getProdutoById($id_produto)->quantidade);
    if ($quant > $quantidadeConsultada) {
        $_SESSION["resposta"] = "Quantidade maior do que o estoque de " . $quantidadeConsultada . " unidades!";
        $_SESSION["vendaid"] = $id_venda;
        header("Location: ../venderProdutos.php");
    } else {
        if (empty(VendaApi::getVendaByIdVendaAndIdProduto($id_venda, $id_produto))) {
            VendaApi::postVenda($id_venda, $id_produto, $quant);
            $_SESSION["vendaid"] = $id_venda;
            $quantidadeRestante = $quantidadeConsultada - $quant;
            if(ProdutoApi::putAtualizarEstoque($quantidadeRestante, $id_produto)){
                header("Location: ../venderProdutos.php");
            }
        } else {
            $_SESSION["resposta"] = "Produto já foi selecionado!";
            $_SESSION["vendaid"] = $id_venda;
            header("Location: ../venderProdutos.php");
        }
    }
}
