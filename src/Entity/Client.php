<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $mdp;

      /**
      * @ORM\Column(type="string", columnDefinition="ENUM('homme', 'femme')")
     */
    private $civilite;

    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('client', 'admin')")
   */
  private $utilisateur;


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
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
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

    /***********************************/
    public function getMdp()
    {
        return $this->mdp;
    }
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /***********************************/
    public function getCivilite()
    {
        return $this->civilite;
    }
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }


    private $article;
    public function __construct() {
        $this->article = new ArrayCollection();
    }

    public function __toString()
    {
        $format = " Article (id: %s, nom: %s, adresse: %s, email: %s, mdp: %s, civilite: %s, utilisateur: %s)";
        return sprintf($format, $this->id,$this->nom,$this->adresse,$this->email,$this->mdp,$this->civilite,$this->utilisateur);
    }
}
