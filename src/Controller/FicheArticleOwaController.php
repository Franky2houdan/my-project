<?php
// src/Controller/FicheArticleController.php
//exemple syntax lien twig {{ url(name, parameters = [], schemeRelative = false) }}
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

class FicheArticleOwaController extends Controller
{
  /**
   * @Route("/owa/ficheArticle{id}", name="ficheArticleOwa")
    */
    public function index($id){
		 $form = $this->createFormBuilder($article)
            ->setMethod('GET')
            ->add('designation', TextType::class,array('label' => false,'required' => false, 'attr' => array('class' => 'srchTxt','placeholder'=>'Recherche')))
            ->add('categorie', ChoiceType::class, array('label' => false,'required' => false,'attr' => array('class' => 'srchTxt'),'choices'=>array(
              'Tout' => '',
              'Fruit' => 'fruit',
              'Legume' => 'legume',
            )))
            ->add('save', SubmitType::class, array('label' => 'Recherche','attr' => array('id' =>'submitButton','class' => 'btn btn-primary')))
            ->getForm();
		
      $article=new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->trouveUnArticle($id);
      return $this->render('owa/ficheArticle.html.twig', array('produit' =>$article,'suggestion'=>'bordel','form' =>$form->createView()));
    }

}
