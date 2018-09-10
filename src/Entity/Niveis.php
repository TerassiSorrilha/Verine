<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveisRepository")
 */
class Niveis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Usuarios", mappedBy="nivel")
     */
    protected $usuarios;

    //==================================================================================================================
    public function __construct()
    {
        $this->usuarios = new ArrayCollection();    // precisa ser arraycollection
    }

    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Nome" => (!empty($this->name)) ? $this->getName(): "",
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

    /**
     * @return mixed
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
