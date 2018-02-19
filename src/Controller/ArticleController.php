<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleController extends Controller
{
  /**
   * @Route("/siteCom", name="siteCom")
   */
  public function afficheArticle(request $request){ 
   if(!empty($_GET['form']['designation']) && !empty($_GET['form']['categorie'])){
    $designation=$_GET['form']['designation'];
    $categorie=$_GET['form']['categorie'];
    $article=new Article();
    $article = $this->getDoctrine()
    ->getRepository(Article::class)
    ->chercheUnArticle($designation,$categorie);
 
   }elseif(!empty($_GET['form']['categorie']) && empty($_GET['form']['designation'])){
  
    $categorie=$_GET['form']['categorie'];
    $article=new Article();
    $article = $this->getDoctrine()
    ->getRepository(Article::class)
    ->chercheUneCategorie($categorie);
  
   }elseif(!empty($_GET['form']['designation']) && empty($_GET['form']['categorie'])){
     
      $designation=$_GET['form']['designation'];
      $article=new Article();
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->chercheUneDesignation($designation);
    
   }else{
    echo 'index';
    $article=new Article();
    $article = $this->getDoctrine()
    ->getRepository(Article::class)
    ->afficheListeArticle();    
   };
  
    $form = $this->createFormBuilder($article)
    ->setMethod('GET')
    ->add('designation', TextType::class,array('label' => false,'required' => false, 'attr' => array('class' => 'srchTxt')))
    ->add('categorie', ChoiceType::class, array('label' => false,'required' => false,'attr' => array('class' => 'srchTxt'),'choices'=>array(
      'Tout' => '',
      'Homme' => 'homme',
      'Femme' => 'femme'
    )))
    ->add('save', SubmitType::class, array('label' => 'Recherche','attr' => array('id' =>'submitButton','class' => 'btn btn-primary')))
    ->getForm();

    $paginator  = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
           $article, /* query NOT result */
           $request->query->getInt('page', 1)/*page number*/,
           $request->query->getInt('limit', 6)/*limit per page*/
       );
       //parameters to template
       return $this->render('siteCom/index.html.twig', array('pagination' => $pagination,'form' =>$form->createView()));
  }

}
