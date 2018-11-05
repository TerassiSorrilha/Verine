<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JogadorRepository")
 */
class Jogador extends Pessoa
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clube", inversedBy="jogadores")
     * @ORM\JoinColumn(name="jogadores_id", referencedColumnName="id")
     */
    private $clube;

    /**
     * @ORM\Column(type="string")
     */
    private $posicao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Market", mappedBy="jogador")
     */
    private $market;

    //==================================================================================================================
    public function __construct()
    {
        $this->market = new ArrayCollection();    // precisa ser arraycollection
    }

    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Nome" => (!empty($this->name)) ? $this->getName(): "",
            "Clube" => (!empty($this->clube))? $this->getClube()->getName(): "",
            "Posição" => (!empty($this->posicao))? $this->getPosicao(): "",
        ];

        // gera nomes
        return $array;
    }

    /**
     * @return mixed
     */
    public function getClube()
    {
        return $this->clube;
    }

    /**
     * @param mixed $clube
     */
    public function setClube($clube): void
    {
        $this->clube = $clube;
    }

    /**
     * @return mixed
     */
    public function getPosicao()
    {
        return $this->posicao;
    }

    /**
     * @param mixed $posicao
     */
    public function setPosicao($posicao): void
    {
        $this->posicao = $posicao;
    }


}
