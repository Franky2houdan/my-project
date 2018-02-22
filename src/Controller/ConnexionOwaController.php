<?php
// src/Controller/ConnnexionController.php
namespace App\Controller;

use App\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class ConnexionOwaController extends Controller
{
    /**
   * @Route("/owa/connexion", name="connexionOwa")
   */
    public function connect(Request $request)
    {
      // create a client and give it some dummy data for this example
      $client = new Client();
      $clientSelect = new Client();
      $clientSelect =$this->getDoctrine()
      ->getRepository(Client::class)
      ->afficheListeClient();
      //récup tous les clients
      $form = $this->createFormBuilder($client)
      ->add('Email', TextType::class,array('label'=> false,'attr'=>array('placeholder'=>'Email')))
      ->add('mdp', PasswordType::class,array('label'=> false,'attr'=>array('placeholder'=>'Email')))
      ->add('save', SubmitType::class, array('label' => 'Se Connecter','attr'=>array('class'=>'btn btn-success')))
      ->getForm();
      $form->handleRequest($request);
      /*comparer la saisie avec la base*/

      if ($form->isSubmitted() && $form->isValid()) {
        $clientForm = $form->getData();

        foreach ($clientSelect as $key => $value) {
          if(($value->getEmail() == $clientForm->getEmail()) && (password_verify($clientForm->getMdp(),$value->getMdp()))) {
              if($value->getUtilisateur()=='client'){
                $session = new Session();
                $session->start();
                // set and get session attributes
                $session->set('nom',$value->getNom());
                $session->set('email',$value->getEmail());
                $session->set('adresse',$value->getAdresse());
                $session->set('mdp',$value->getMdp());
                $session->set('civilite',$value->getCivilite());
                $session->set('id',$value->getId());
                return $this->redirectToRoute('index');
              }else{
                return $this->redirectToRoute('easy_admin_bundle');
              }
            }
        }
      }
    return $this->render('owa/connexion.html.twig',array('form'=>$form->createView()));
  }
}
