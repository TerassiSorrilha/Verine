<?php

namespace App\Entity;

use App\Utils\Tools;
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

    /**
     * @return float
     */
    public function getPrecoCompra()
    {
        return Tools::moneyUser(($this->preco_venda * 0.95));
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
        return Tools::moneyUser($this->preco_venda);
    }

    /**
     * @param mixed $preco_venda
     */
    public function setPrecoVenda($preco_venda): void
    {
        // preciso formatar para o valor correto
        $this->preco_venda = Tools::MoneyDb($preco_venda);
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
