<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AchatRepository")
 */
class Achat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    // add your own fields

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateA;

/*******************getter setter***************************/

    public function getId()
    {
        return $this->id;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    public function getDateA()
    {
        return  $this->dateA;
    }

    public function setDateA($dateA)
    {
       $this->dateA = new \DateTime("now");

    }
    /*************************************/

          /**
           * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="achat")
           * @ORM\JoinColumn(nullable=true)
           */
           private $fournisseur;
           public function getFournisseur()
           {
               return $this->fournisseur;
           }
           public function setFournisseur($fournisseur)
           {
               $this->fournisseur = $fournisseur;
           }

           /**
            * @ORM\ManyToOne(targetEntity="App\Entity\article", inversedBy="achat")
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
