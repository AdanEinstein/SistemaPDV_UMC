<?php

class DAO
{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "crudphp";
    private $driver = "mysql";
//    private $host = "localhost";
//    private $user = "id18903666_grupoumc";
//    private $pass = "TfsMeWF5n2)+&zr";
//    private $db = "id18903666_crudphp";
//    private $driver = "mysql";

    private function conexao()
    {
        try {
            $conexao = new PDO("{$this->driver}:host={$this->host};dbname={$this->db}", "{$this->user}", "{$this->pass}");
            return $conexao;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function executeSQL($sql, $arrayParams)
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
            throw new RuntimeException("Parâmetros inválidos!");
        }
    }

    public function select($sql, $arrayParams = null, $todos = false, $objeto = false)
    {
        try {
            if ($arrayParams) {
                $stmt = $this->conexao()->prepare($sql);
                foreach ($arrayParams as $chave => &$valor) {
                    $stmt->bindParam($chave, $valor);
                }
                $stmt->execute();
                return $todos ? $stmt->fetchAll(PDO::FETCH_OBJ) : $objeto ? $stmt->fetch(PDO::FETCH_OBJ) : $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return $this->conexao()->query($sql)->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }
}
