<?php
// src/Controller/FicheArticleController.php
//exemple syntax lien twig {{ url(name, parameters = [], schemeRelative = false) }}
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
      $form = $this->createFormBuilder($article)
      ->setMethod('GET')
      ->add('designation', TextType::class,array('label' => false, 'attr' => array('id' =>'false','class' => 'srchTxt')))
      ->add('categorie', ChoiceType::class, array('label' => false,'attr' => array('id' =>'false','class' => 'srchTxt'),'choices'=>array(
        'Homme' => 'homme',
        'Femme' => 'femme'
      )))
      ->add('save', SubmitType::class, array('label' => 'Recherche','attr' => array('id' =>'submitButton','class' => 'btn btn-primary')))
      ->getForm();
      return $this->render('siteCom/ficheArticle.html.twig', array('produit' =>$article,'suggestion'=>'bordel','form' =>$form->createView()));
    }

}
