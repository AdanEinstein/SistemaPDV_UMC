<?php

class Total
{
    private $id;
    private $idVenda;
    private $dataVenda;
    private $total;

    public function __construct(int $id, int $idVenda, DateTime $dataVenda, float $total)
    {
        $this->setId($id);
        $this->setIdVenda($idVenda);
        $this->setDataVenda($dataVenda);
        $this->setTotal($total);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdVenda(): int
    {
        return $this->idVenda;
    }

    public function setIdVenda(int $idVenda): void
    {
        $this->idVenda = $idVenda;
    }

    public function getDataVenda(): DateTime
    {
        return $this->dataVenda;
    }

    public function setDataVenda(DateTime $dataVenda): void
    {
        $this->dataVenda = $dataVenda;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

}