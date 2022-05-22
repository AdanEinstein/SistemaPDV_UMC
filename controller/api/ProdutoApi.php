<?php
require_once(__DIR__ . "/../../database/classDAO.php");
require_once(__DIR__ . "/../../model/classProdutos.php");

class ProdutoApi
{
    public static function getProdutoByDecricao(string $descricao)
    {
        $conexao = new DAO();
        $consultaSQL = "SELECT * FROM pdv_produtos WHERE descricao = :descricao";
        return $conexao->select($consultaSQL, [":descricao" => $descricao]);
    }

    public static function descricaoExists(string $descricao, int $id)
    {
        $conexao = new DAO();
        $consultaSQL = "SELECT * FROM pdv_produtos WHERE descricao LIKE :descricao AND id <> :id";
        return $conexao->select($consultaSQL, [":descricao" => $descricao, ":id" => $id]);
    }

    public static function getProdutoById(int $id)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_produtos WHERE id = :id";
        $param = [":id" => $id];
        return $conexao->select($sql, $param, false, true);
    }

    public static function getProdutosByIdVenda(int $idVenda)
    {
        $conexao = new DAO();
        $sql = "SELECT prod.id as id, prod.descricao as descricao, prod.preco as preco, vend.quantidade as quantidade 
                FROM pdv_produtos prod INNER JOIN pdv_vendas vend ON prod.id = vend.id_produto 
                WHERE vend.id_venda = $idVenda";
        return $conexao->select($sql, null, true);
    }

    public static function getProdutos()
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_produtos";
        return $conexao->select($sql, null, true);
    }

    public static function postProduto(string $descricao, string $preco, string $quantidade): bool
    {
        $conexao = new DAO();
        $sql = "INSERT INTO pdv_produtos VALUES (DEFAULT, :descricao, :preco, :quantidade)";
        $formatarQuantidade = str_replace(",", ".", $quantidade);
        $formatarPreco = str_replace(",", ".", $preco);
        $params = [":descricao" => $descricao, ":preco" => $formatarPreco, ":quantidade" => $formatarQuantidade];
        return $conexao->executeSQL($sql, $params);
    }

    public static function putProduto(int $id, string $descricao, string $preco, string $quantidade)
    {
        $conexao = new DAO();
        $sql = "UPDATE pdv_produtos SET descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id";
        $formatarQuantidade = str_replace(",", ".", $quantidade);
        $formatarPreco = str_replace(",", ".", $preco);
        $params = [":descricao" => $descricao, ":preco" => $formatarPreco, ":quantidade" => $formatarQuantidade, ":id" => $id];
        return $conexao->executeSQL($sql, $params);
    }

    public static function putAtualizarEstoque(int $quantidade, int $idProduto)
    {
        $conexao = new DAO();
        $sql = "UPDATE pdv_produtos SET quantidade = :quantidade WHERE id = :idProduto";
        $params = [":quantidade"=>$quantidade, ":idProduto"=> $idProduto];
        return $conexao->executeSQL($sql, $params);
    }

    public static function deleteProduto(int $id)
    {
        $conexao = new DAO();
        $sql = "DELETE FROM pdv_produtos WHERE id = :id";
        $params = [":id" => $id];
        return $conexao->executeSQL($sql, $params);
    }
}
