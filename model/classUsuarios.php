<?php
class Usuario{
    private $id;
    private $login;
    private $senha;
    private $perfil;

    public function __construct(int $id = null, string $login = null, string $senha = null, string $perfil = null)
    {
        $this->setId($id);
        $this->setLogin($login);
        $this->setSenha($senha);
        $this->setPerfil($perfil);
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): void
    {
        if($id > 0){
            $this->id = $id;
        }
    }
    public function getLogin(): string
    {
        return $this->login;
    }
    public function setLogin($login): void
    {
        $this->login = $login;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function setSenha($senha): void
    {
       $this->senha = $senha;
    }
    public function getPerfil(): string
    {
        return $this->perfil;
    }
    public function setPerfil($perfil): void
    {
         switch($perfil){
             case 'adm':
                $this->perfil ='adm';
                break;
            case 'padrão':
                $this->perfil = 'padrão';
                break;
            case 'pendente':
                $this->perfil = 'pendente';
                break;
                
            default:
         }
    }
}