<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
//include_once('fonction-panier.php');
class PanierController extends Controller
{
  /**
   * @Route("/siteCom/panier", name="panier")
   */
  public function panier(){
    if (isset($_SESSION['panier']))
    {
      print_r($_SESSION);
       //Nous allons passer par un panier temporaire
       $tmp=array();
       $tmp['libelleProduit'] = array();
       $tmp['qteProduit'] = array();
       $tmp['prixProduit'] = array();
      if(isset($_SESSION['panier']['desigantion'])){
       for($i = 0; $i < count($_SESSION['panier']['designation']); $i++)
       {
          if ($_SESSION['panier']['desigantion'][$i] !== $libelleProduit)
          {
             array_push( $tmp['libelleProduit'],$_SESSION['panier']['deisgnation'][$i]);
             array_push( $tmp['qteProduit'],$_SESSION['panier']['qte'][$i]);
             array_push( $tmp['prixProduit'],$_SESSION['panier']['prix'][$i]);
          }
       }
        //On remplace le panier en session par notre panier temporaire à jour
        $_SESSION['panier'] =  $tmp;
        //On efface notre panier temporaire
        unset($tmp);
          //Si la quantité est positive on modifie sinon on supprime l'article
          if (isset($qteProduit)&&$qteProduit > 0)
          {
             //Recharche du produit dans le panier
             $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
    
             if ($positionProduit !== false)
             {
                $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
             }
          }
          else
          supprimerArticle($libelleProduit);
       }

       function MontantGlobal(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
        {
           $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
     }

     $total=0;
     for($i = 0; $i < count($_SESSION['panier']['designation']); $i++)
     {
        $total += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
     }
     
      }
      
    


    
    $article=new Article();
    $article = $this->getDoctrine()
    ->getRepository(Article::class)
    ->afficheListeArticle();
    $form = $this->createFormBuilder($article)
    ->setMethod('GET')
    ->add('designation', TextType::class,array('label' => false, 'attr' => array('id' =>'false','class' => 'srchTxt')))
    ->add('categorie', ChoiceType::class, array('label' => false,'attr' => array('id' =>'false','class' => 'srchTxt'),'choices'=>array(
      'Homme' => 'homme',
      'Femme' => 'femme'
    )))
    ->add('save', SubmitType::class, array('label' => 'Recherche','attr' => array('id' =>'submitButton','class' => 'btn btn-primary')))
    ->getForm();

###############################################################################################################

 

 
     
      //print_r($session);
      //  $session->invalidate();
      return $this->render('siteCom/panier.html.twig',array('form'=>$form->createView(),'session'=>$_SESSION));
  }

  }
