<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

class ArticleOwaController extends Controller
{

    /**
     * @Route("/owa", name="owa")
     */
    public function afficheArticleOwa(request $request){
      $article=new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->afficheListeArticle();

      $paginator  = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
             $article, /* query NOT result */
             $request->query->getInt('page', 1)/*page number*/,
             $request->query->getInt('limit', 5)/*limit per page*/
         );
         // parameters to template
         return $this->render('owa/index.html.twig', array('pagination' => $pagination));
    }

}
