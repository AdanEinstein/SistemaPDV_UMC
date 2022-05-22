<?php
require_once(__DIR__ . "/../../database/classDAO.php");
require_once(__DIR__ . "/../../model/classVendas.php");

class VendaApi
{
    public static function getVendaById(int $idVenda)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_vendas WHERE id_venda = :idVenda";
        return $conexao->select($sql, [":idVenda"=>$idVenda], true);
    }

    public static function getMaxIdVenda()
    {
        $conexao = new DAO();
        $sql = "SELECT MAX(id_venda) as id FROM pdv_vendas";
        return $conexao->select($sql, null, false, true);
    }

    public static function getVendaByIdVendaAndIdProduto(int $idVenda, int $idProduto)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_vendas WHERE id_venda = :id_venda AND id_produto = :id_produto";
        return $conexao->select($sql, [":id_venda" => $idVenda, ":id_produto" => $idProduto], false, true);
    }

    public static function postVenda(int $idVenda, int $idProduto, int $quant)
    {
        $conexao = new DAO();
        $sql = "INSERT INTO pdv_vendas(id_venda, id_produto, quantidade) VALUES (:idVenda, :idProduto, :quantidade)";
        $params = [":idVenda" => $idVenda, ":idProduto" => $idProduto, ":quantidade" => $quant];
        return $conexao->executeSQL($sql, $params);
    }

    public static function deleteVenda(int $idVenda, int $idProduto)
    {
        $conexao = new DAO();
        $sql = "DELETE FROM pdv_vendas WHERE id_venda = :idvenda AND id_produto = :idproduto";
        $params = [":idvenda" => $idVenda, ":idproduto" => $idProduto];
        return $conexao->executeSQL($sql, $params);
    }
}