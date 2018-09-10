<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TODOQuadrosRepository")
 */
class TODOQuadros
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
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuarios", inversedBy="quadros")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TODOListas", mappedBy="quadros")
     */
    private $listas;

    //==================================================================================================================
    public function __construct()
    {
        $this->listas = new ArrayCollection();    // precisa ser arraycollection
    }

    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Nome" => (!empty($this->nome)) ? $this->getNome(): "",
            "Usuario" => (!empty($this->usuario)) ? $this->getUsuario()->getName(): "",
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getListas()
    {
        return $this->listas;
    }

}
