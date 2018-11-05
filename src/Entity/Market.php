<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarketRepository")
 */
class Market
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $preco_venda;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Jogador", inversedBy="market")
     * @ORM\JoinColumn(name="jogador_id", referencedColumnName="id")
     */
    private $jogador;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $is_active;

    private $preco_compra;

    // =================================================================================================================
    public function __construct()
    {
        $this->is_active = true;
        $this->preco_compra = $this->preco_venda * 0.95;
    }

    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Jogador" => (!empty($this->jogador)) ? $this->getJogador()->getName(): "",
            "Preço Venda" => (!empty($this->preco_venda)) ? number_format($this->getPrecoVenda(), 2, '.', ','): "",
            "Preço Compra" => number_format($this->getPrecoCompra(), 2, '.', ','),
        ];

        // gera nomes
        return $array;
    }

    /**
     * @return float
     */
    public function getPrecoCompra(): float
    {
        return $this->preco_venda * 0.95;
    }


    /**
     * @return mixed
     */
    public function getJogador()
    {
        return $this->jogador;
    }

    /**
     * @param mixed $jogador
     */
    public function setJogador($jogador): void
    {
        $this->jogador = $jogador;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrecoVenda()
    {
        return $this->preco_venda;
    }

    /**
     * @param mixed $preco_venda
     */
    public function setPrecoVenda($preco_venda): void
    {
        $this->preco_venda = $preco_venda;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->is_active;
    }

    /**
     * @param mixed $is_active
     */
    public function setIsActive($is_active): void
    {
        $this->is_active = $is_active;
    }
}
