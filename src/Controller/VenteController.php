<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Client;
use App\Entity\Vente;

class VenteController extends Controller
{
    /**
     * @Route("/vente", name="vente")
     */
    public function index()
    {

      $client_id=2;
      $article_id=2;
      $client = new Client();
      $client = $this->getDoctrine()
      ->getRepository(Client::class)
      ->find($client_id);

      $article = new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->find($article_id);

      $vente = new Vente();
      $vente->setQuantite(3);
      $vente->setDate_v(new \DateTime('now'));
     // relate this product to the category
     $vente->setClient($client);
     $vente->setArticle($article);
     $em = $this->getDoctrine()->getManager();
     $em->persist($vente);
     $em->flush();

      return new Response('Facture n°'.$vente->getId()
      .'<br> votre vente  est '.$article->getDesignation()
        .'<br> votre vente  est '.$vente->getQuantite()
          .'<br> la date d\'vente est '.$vente->getDate_v('Y-m-d')
      .'<br>la référence du client est '.$client->getId()
      .'<br> Le nom du client est '.$client->getNom());

    }
}
