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
            $stmt->execute();
        } elseif (func_num_args() == 2) {
            foreach ($arrayParams as $chave => $valor) {
                $stmt->bindParam($chave, $valor);
            }
            $stmt->execute();
        } else {
            throw new \http\Exception\RuntimeException("Parâmetros inválidos!");
        }
    }

    public function listData()
    {
        return $this->obj->fetchALL();
    }
}

?>
