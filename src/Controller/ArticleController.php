<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
  /**
   * @Route("/siteCom", name="siteCom")
   */
  public function afficheArticle(request $request){
    $article=new Article();
    $article = $this->getDoctrine()
    ->getRepository(Article::class)
    ->afficheListeArticle();
    $paginator  = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
           $article, /* query NOT result */
           $request->query->getInt('page', 1)/*page number*/,
           $request->query->getInt('limit', 6)/*limit per page*/
       );
       // parameters to template
       return $this->render('siteCom/index.html.twig', array('pagination' => $pagination));
  }
}
