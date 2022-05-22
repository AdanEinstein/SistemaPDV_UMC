<?php
require_once(__DIR__ . "/../../database/classDAO.php");
require_once(__DIR__ . "/../../model/classTotal.php");

class TotalApi
{
    public static function existsVendaFromTotal(int $idVenda)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_total WHERE id_venda = :id_venda";
        return $conexao->select($sql, [":id_venda" => $idVenda]);
    }

    public static function postTotal(int $idVenda, string $total)
    {
        $conexao = new DAO();
        $dataAtual = date('Y-m-d');
        $sql = "INSERT INTO pdv_total(id, id_venda ,data_venda, total) VALUES (DEFAULT, :idvenda, :datavenda, :total)";
        $params = [":idvenda"=>$idVenda,":datavenda"=>$dataAtual, ":total"=>$total];
        return $conexao->executeSQL($sql, $params);
    }

    public static function getTotalVendasByDate(string $dataInicial)
    {
        $conexao = new DAO();
        $sql = "SELECT tot.data_venda, SUM(tot.total) as total FROM pdv_total tot 
                WHERE tot.data_venda >= '$dataInicial'
                GROUP BY tot.data_venda ORDER BY tot.data_venda DESC";
        return $conexao->select($sql, null, true);
    }

    public static function getTotalVendasByCurrentDate()
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_total tot 
                WHERE tot.data_venda = CURRENT_DATE() 
                GROUP BY tot.id_venda ORDER BY tot.data_venda DESC";
        return $conexao->select($sql, null, true);
    }
}