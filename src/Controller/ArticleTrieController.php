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

    public function index(){
      return $this->render('siteCom/index.html.twig', array('produit' =>$article,'suggestion'=>'bordel'));
    }

}
