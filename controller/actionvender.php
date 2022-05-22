<?php
require_once(__DIR__ . "/api/VendaApi.php");
require_once(__DIR__."/api/TotalApi.php");
session_start();
if (isset($_POST["vendaid"])) {
    $id_venda = $_POST["vendaid"];
    if (empty(VendaApi::getVendaById($id_venda))) {
        $total = $_POST["total"];
        if (TotalApi::postTotal($id_venda, $total)) {
            $_SESSION["vendaid"] = null;
            header("Location: ../venderProdutos.php");
        }
    } else {
        $_SESSION["resposta"] = "Para confirmar a venda deve haver pelo menos um item na lista!";
        header("Location: ../venderProdutos.php");
    }
} else {
    $_SESSION["resposta"] = "Erro ao confirmar a venda!";
    header("Location: ../venderProdutos.php");
}
