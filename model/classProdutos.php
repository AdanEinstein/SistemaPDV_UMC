<?php

class Produto{
    private $id;
    private $descricao;
    private $preco;
    private $quantidade;

    public function __construct(int $id = null, string $descricao = null, string $preco = null, string $quantidade = null)
    {
        $this->setId($id);
        $this->setDescricao($descricao);
        $this->setPreco($preco);
        $this->setQuantidade($quantidade);
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
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    public function setDescricao($descricao): void
    {
        $this->login = $descricao;
    }
    public function getPreco(): float
    {
        return $this->preco;
    }
    public function setPreco($preco): void
    {
       $this->senha = $preco;
    }
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
    public function setQuantidade($quantidade): void
    {
         $this->quantidade = $quantidade;
    }
}