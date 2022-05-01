<?php

class DAO
{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "crudphp";
    private $driver = "mysql";


    private function conexao()
    {
        try {
            $conexao = new PDO("{$this->driver}:host={$this->host};dbname={$this->db}", "{$this->user}", "{$this->pass}");
            return $conexao;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    function executeSQL($sql, $arrayParams)
    {
        $stmt = $this->conexao()->prepare($sql);
        if (func_num_args() == 1) {
            $stmt->execute();
        } elseif (func_num_args() == 2) {
            foreach ($arrayParams as $chave => &$valor) {
                $stmt->bindParam($chave, $valor);
            }
            return $stmt->execute();
        } else {
            throw new \http\Exception\RuntimeException("Parâmetros inválidos!");
        }
    }

    function selectParam($sql, $arrayParams)
    {
        $stmt = $this->conexao()->prepare($sql);
        if (func_num_args() == 1) {
            $stmt->execute();
        } elseif (func_num_args() == 2) {
            foreach ($arrayParams as $chave => &$valor) {
                $stmt->bindParam($chave, $valor);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new \http\Exception\RuntimeException("Parâmetros inválidos!");
        }
    }

    public function selectAll($sql)
    {
        try {
            return $this->conexao()->query($sql);
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }
}
