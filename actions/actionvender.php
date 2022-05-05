<?php
require "../banco/conexBanco.php";
session_start();
$conexao = new DAO();
if(isset($_POST["vendaid"])){
    $id_venda = $_POST["vendaid"];
    $sql = "SELECT * FROM pdv_vendas WHERE id_venda = '$id_venda'";
    $existe = $conexao->select($sql, null, true);
    if($existe->rowCount() > 0){
        $dataAtual = date('Y-m-d');
        $sql = "INSERT INTO pdv_total(id, id_venda, data_venda) VALUES (DEFAULT, :idvenda, :datavenda)";
        $params = [":idvenda"=>$id_venda, ":datavenda"=>$dataAtual];
        $conexao->executeSQL($sql, $params);
        $_SESSION["vendaid"] = null;
        header("Location: ../venderProdutos.php");
    } else {
        $_SESSION["resposta"] = "Para confirmar a venda deve haver pelo menos um item na lista!";
        header("Location: ../venderProdutos.php");
    }
}
