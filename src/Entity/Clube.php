<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubeRepository")
 */
class Clube
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Liga", inversedBy="clubes")
     * @ORM\JoinColumn(name="clubes_id", referencedColumnName="id")
     */
    private $liga;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jogador", mappedBy="clube")
     */
    private $jogadores;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    //==================================================================================================================
    public function __construct()
    {
        $this->jogadores = new ArrayCollection();    // precisa ser arraycollection
    }

    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Nome" => (!empty($this->name)) ? $this->getName(): "",
            "Liga" => (!empty($this->liga))? $this->getLiga()->getName(): "",
        ];

        // gera nomes
        return $array;
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
    public function getLiga()
    {
        return $this->liga;
    }

    /**
     * @param mixed $liga
     */
    public function setLiga($liga): void
    {
        $this->liga = $liga;
    }

    /**
     * @return mixed
     */
    public function getJogadores()
    {
        return $this->jogadores;
    }

    /**
     * @param mixed $jogadores
     */
    public function setJogadores($jogadores): void
    {
        $this->jogadores = $jogadores;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}
