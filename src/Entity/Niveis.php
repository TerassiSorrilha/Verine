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
    public function headers(){
        $array = get_object_vars($this);

        // verifica se é um array collection
        foreach ($array as $k => $v){
            if (is_object($v)) {
                $array[$k] = $v->count();
            }
        }

        return $array;
    }

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();    // precisa ser arraycollection
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
