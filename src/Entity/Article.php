<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * campos gerados fora do BS
     */

    private $link;
    private $subtitle;

    //==================================================================================================================
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuarios", inversedBy="articles")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @ORM\Column(type="string")
     */
    private $name;  // title

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datepost;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation;


    // =================================================================================================================
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return mixed
     */
    public function getDatepost()
    {
        return $this->datepost;
    }

    /**
     * @param mixed $datepost
     */
    public function setDatepost($datepost): void
    {
        $this->datepost = $datepost;
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
    public function getLink()
    {
        $this->link = strtolower(str_replace(' ', '-', $this->getName()));
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param mixed $datecreation
     */
    public function setDatecreation($datecreation): void
    {
        $this->datecreation = $datecreation;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }
}
