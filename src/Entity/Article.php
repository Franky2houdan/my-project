<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */

    private $id;

    // add your own fields

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $designation;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $prix;

       /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $tva;

      /**
     * @ORM\Column(type="string", length=70)
     */
    private $adresPhoto;

      /**
     * @ORM\Column(type="decimal",scale=2)
     */
    private $coef;
 /**
     * @ORM\Column(type="decimal",scale=2)
     */
    private $promo;
    /**************getter setter******** */
    public function getId()
    {
        return $this->id;
    }

    public function getCoef()
    {
        return $this->coef;
    }

    public function setCoef($coef)
    {
        $this->coef = $coef;
    }

    public function getPromo()
    {
        return $this->promo;
    }

    public function setPromo($promo)
    {
        $this->promo = $promo;
    }


    public function getDesignation()
    {
        return $this->designation;
    }

    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }


    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }


    public function getTva()
        {
        return $this->tva;
    }

    public function setTva($tva)
    {
        $this->tva = $tva;
    }


    public function getAdresPhoto()
    {
        return $this->adresPhoto;
    }

    public function setAdresPhoto($adresPhoto)
    {
        $this->adresPhoto = $adresPhoto;
    }

    // ...

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="article")
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


          public function __toString()
          {
              $format = " Article (id: %s, designation: %s, prix: %s, tva: %s, adresPhoto: %s, coef: %s, fournisseur: %s, promo: %s)";
              return sprintf($format, $this->id,$this->designation,$this->prix,$this->tva,$this->adresPhoto,$this->coef,$this->fournisseur,$this->promo);
          }
}
