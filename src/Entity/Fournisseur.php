<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository")
 */
class Fournisseur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=33)
     */
    private $adresse;

     /**
     * @ORM\Column(type="string", length=33)
     */
    private $email;


  // ... getters & setters pour toute les propriétés

    public function getId()
    {
      return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }
/***********************************/
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /***********************************/
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function __toString()
    {
        $format = " Article (id: %s, nom: %s, email: %s, adresse: %s";
        return sprintf($format, $this->id,$this->nom,$this->adresse,$this->email);
    }

}
