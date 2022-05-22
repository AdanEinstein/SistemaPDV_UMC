<?php

class Venda
{
    private $id;
    private $produto;
    private $quantidade;

    public function __construct(int $id, int $produto, int $quantidade)
    {
        $this->setId($id);
        $this->setProduto($produto);
        $this->setQuantidade($quantidade);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProduto(): int
    {
        return $this->produto;
    }

    public function setProduto(int $produto): void
    {
        $this->produto = $produto;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): void
    {
        $this->quantidade = $quantidade;
    }

}