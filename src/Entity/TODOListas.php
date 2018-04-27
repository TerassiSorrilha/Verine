<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TODOListasRepository")
 */
class TODOListas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TODOQuadros", inversedBy="listas")
     * @ORM\JoinColumn(name="quadros_id", referencedColumnName="id")
     */
    private $quadros;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TODOCartoes", mappedBy="listas")
     */
    private $cartoes;

    //==================================================================================================================
    public function __construct()
    {
        $this->cartoes = new ArrayCollection();    // precisa ser arraycollection
    }

    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Nome" => (!empty($this->nome)) ? $this->getNome(): "",
            "Quadros" => (!empty($this->quadros)) ? $this->getQuadros()->getNome(): "",
            "E-mail" => (!empty($this->is_active)) ? $this->getisActive(): ""
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
    public function getQuadros()
    {
        return $this->quadros;
    }

    /**
     * @param mixed $quadros
     */
    public function setQuadros($quadros): void
    {
        $this->quadros = $quadros;
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

    /**
     * @return mixed
     */
    public function getCartoes()
    {
        return $this->cartoes;
    }

}
