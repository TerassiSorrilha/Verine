<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TODOCartoesRepository")
 */
class TODOCartoes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TODOListas", inversedBy="cartoes")
     * @ORM\JoinColumn(name="listas_id", referencedColumnName="id")
     */
    private $listas;

    /**
     * @ORM\Column(type="integer")
     */
    private $posicao;

    /**
     * @ORM\Column(type="string")
     */
    private $descricao;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    //==================================================================================================================
    public function relatorio(){
        $array = [
            "Id" => (!empty($this->id)) ? $this->getId(): "",
            "Nome" => (!empty($this->nome)) ? $this->getNome(): "",
            "Listas" => (!empty($this->quadros)) ? $this->getListas()->getNome(): "",
            "Descricao" => (!empty($this->descricao)) ? $this->getDescricao(): "",
            "Ativo" => (!empty($this->is_active)) ? $this->getisActive(): "",
            "Posicao" => (!empty($this->nome)) ? $this->getPosicao(): "",
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
    public function getListas()
    {
        return $this->listas;
    }

    /**
     * @param mixed $listas
     */
    public function setListas($listas): void
    {
        $this->listas = $listas;
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

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
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


}
