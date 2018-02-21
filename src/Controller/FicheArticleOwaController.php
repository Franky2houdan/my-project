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
      $article=new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->trouveUnArticle($id);
      $form = $this->createFormBuilder($article)
      ->setMethod('GET')
      ->add('designation', TextType::class,array('label' => false, 'attr' => array('id' =>'false','class' => 'srchTxt')))
      ->add('categorie', ChoiceType::class, array('label' => false,'attr' => array('id' =>'false','class' => 'srchTxt'),'choices'=>array(
        'Fruit' => 'fruit',
        'Légume' => 'legume'
      )))
      ->add('save', SubmitType::class, array('label' => 'Recherche','attr' => array('id' =>'submitButton','class' => 'btn btn-primary')))
      ->getForm();
      foreach ($article as $key => $value) {
      $prix = $value->getPrix();
      $designation = $value->getDesignation();
      }
      $formPanier = $this->createFormBuilder($article)
      ->setMethod('GET')
      ->add('designation', HiddenType::class,array('label' => false,'data' => $designation))
      ->add('prix',HiddenType::class, array('label' => false,'data' => $prix))
      ->add('quantite',IntegerType::class, array('label' => false, 'attr'=>array('class'=>'span1','placeholder'=>true)))
      ->add('save', SubmitType::class, array('label' => 'Ajouter au panier','attr' => array('class' => 'btn btn-large btn-primary pull-right')))
      ->getForm();

      return $this->render('owa/ficheArticle.html.twig', array('produit' =>$article,'suggestion'=>'bordel','form' =>$form->createView(),'formPanier'=>$formPanier->createView()));
    }

    }


