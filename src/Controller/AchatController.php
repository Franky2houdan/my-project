<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Fournisseur;
use App\Entity\Achat;

class AchatController extends Controller
{
    /**
     * @Route("/achat", name="achat")
     */
    public function index()
    {
      $fournisseur_id=2;
      $article_id=2;
      $fournisseur = new Fournisseur();
      $fournisseur = $this->getDoctrine()
      ->getRepository(Fournisseur::class)
      ->find($fournisseur_id);

      $article = new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->find($article_id);

      $achat = new Achat();
      $achat->setQuantite(3);
      $achat->setDate_a(new \DateTime('now'));
     // relate this product to the category
     $achat->setFournisseur($fournisseur);
     $achat->setArticle($article);
     $em = $this->getDoctrine()->getManager();
     $em->persist($achat);
     $em->flush();

      return new Response('Facture n°'.$achat->getId()
      .'<br> votre achat  est '.$article->getDesignation()
      .'<br> votre achat  est '.$achat->getQuantite()
      .'<br> la date d\'achat est '.$achat->getDate_a('Y-m-d')
      .'<br>la référence du fournisseur est '.$fournisseur->getId()
      .'<br> Le nom du fournisseur est '.$fournisseur->getNom());


    }

}
