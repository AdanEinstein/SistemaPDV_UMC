<?php

class bd{

    private $host="localhost",
    $user ="root",
    $pass="",
    $bd="crudphp",
    $driver="mysql";

    private function conexao(){
        try{
            $conexao = new PDO("{$this->driver}:host={$this->host};dbname={$this->db}","{$this->user}","{$this->pass}");
            return $conexao;
        }
        catch(PDOException $e){
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
    public function executeSQL($sql){
        $this->obj = $this->conexao()->prepare($sql);
        
    
       return $this->obj->execute();

    }

    public function listData(){

        return $this->obj->fetchALL();
    }
}


?>
