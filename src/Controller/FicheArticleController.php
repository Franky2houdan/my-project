<?php
// src/Controller/FicheArticleController.php
//exemple syntax lien twig {{ url(name, parameters = [], schemeRelative = false) }}
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

class FicheArticleController extends Controller
{
  /**
   * @Route("/siteCom/ficheArticle{id}", name="ficheArticle")
    */
    public function index($id){
      $article=new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->trouveUnArticle($id);
      return $this->render('siteCom/ficheArticle.html.twig', array('produit' =>$article,'suggestion'=>'bordel'));
    }

}
