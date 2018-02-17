<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Stock;
class StockController extends Controller
{
    /**
     * @Route("/stock", name="stock")
     */
    public function index()
    {
        $id=2;
        $article = new Article();
        $article = $this->getDoctrine()
        ->getRepository(Article::class)
        ->find($id);

        $stock = new Stock();
        $stock->setDesignation('Tomate');
        $stock->setQuantite(50);
        // relate this product to the category
       $stock->setArticle($article);
       $em = $this->getDoctrine()->getManager();
       $em->persist($stock);
       $em->flush();

        return new Response('votre référence est '.$stock->getId()
        .'<br> votre nom est '.$article->getDesignation()
        .'<br>la référence de l\'article est '.$article->getId());
    }


}
