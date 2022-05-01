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
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {

            switch ($e->getCode()) {
                case 2002:
                    echo 'Erro no servidor, Host não encontrado';
                    break;
                case 1049:
                    echo 'Erro no servidor, banco não encontrado';
                    break;
                case 1044:
                    echo 'Erro no servidor, erro de usuário';
                    break;
                default:
                    'Erro no servidor';
                    break;
            }
            exit();
        }
    }

    public function executeSQL($sql, $arrayParams)
    {
        $stmt = $this->conexao()->prepare($sql);
        if (func_num_args() == 1) {
            return $stmt->execute();
        } elseif (func_num_args() == 2) {
            foreach ($arrayParams as $chave => &$valor) {
                $stmt->bindParam($chave, $valor);
            }
            return $stmt->execute();
        } else {
            throw new \http\Exception\RuntimeException("Parâmetros inválidos!");
        }
    }

    public function selectParamSQL($sql, $arrayParams)
    {
        try {
            $stmt = $this->conexao()->prepare($sql);
            foreach ($arrayParams as $chave => &$valor) {
                $stmt->bindParam($chave, $valor);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function selectAll($sql)
    {
        try {
            return $this->conexao()->query($sql);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
