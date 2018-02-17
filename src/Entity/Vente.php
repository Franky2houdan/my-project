<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteRepository")
 */
class Vente
{

        // add your own fields
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
           * @ORM\Column(type="date")
           */
          private $dateV;

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

            public function getDateV()
            {
              return  $this->dateV;
            }
            public function setDateV($dateV)
            {
                 $this->dateV = new \DateTime("now");
            }

            /**
             * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="vente")
             * @ORM\JoinColumn(nullable=true)
             */
             private $client;

             public function getClient()
             {
                 return $this->client;
             }

             public function setClient($client)
             {
                 $this->client = $client;
             }

}
