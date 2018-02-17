<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @ORM\Column(type="string", length=33)
     */
    private $designation;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;
/********************************setter et getter***************************/
    public function getId(){
        return $this->id;
    }

    public function getDesignation()
    {
        return $this->designation;
    }
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="stock")
     * @ORM\JoinColumn(nullable=true)
     */
    private $article;

    public function getArticle()
    {
        return $this->article;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    

}
