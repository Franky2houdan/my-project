<?php
namespace App\Controller;
use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionOwaController extends Controller
{
  /**
   * @Route("/owa/inscription", name="inscriptionOwa")
   */
 public function inscrire(Request $request)
 {
  $article=new Article();
  $article = $this->getDoctrine()
  ->getRepository(Article::class)
  ->afficheListeArticle();  
  $form = $this->createFormBuilder($article)
  ->setMethod('GET')
  ->add('designation', TextType::class,array('label' => false,'required' => false, 'attr' => array('class' => 'srchTxt')))
  ->add('categorie', ChoiceType::class, array('label' => false,'required' => false,'attr' => array('class' => 'srchTxt'),'choices'=>array(
    'Tout' => '',
    'Vin blanc' => 'vin blanc',
    'Vin rosé' => 'vin rosé',
    'Vin rouge' => 'vin rouge'
  )))
  ->add('save', SubmitType::class, array('label' => 'Recherche','attr' => array('id' =>'submitButton','class' => 'btn btn-primary')))
  ->getForm();
   global $client,$clientForm;
   $client = new Client();
   $formInscription = $this->createFormBuilder($client)
          ->add('nom', TextType::class,array('label'=>false,'attr'=>array('placeholder'=>'nom')))
          ->add('adresse', TextType::class,array('label'=>false,'attr'=>array('placeholder'=>'adresse')))
          ->add('email', EmailType::class,array('label'=>false,'attr'=>array('placeholder'=>'email')))
          ->add('mdp', PasswordType::class,array('label'=>false,'attr'=>array('placeholder'=>'mdp')))
          ->add('civilite', ChoiceType::class,array('label'=>false,'choices'=>array(
            'Homme' => 'homme',
            'Femme' => 'femme'
          )))
          ->add('save', SubmitType::class, array('label' => 'incription','attr'=>array('class'=>'btn btn-success')))
          ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $clientForm = $form->getData();
                /**cripter le mdp**/
                 $client->setMdp(password_hash($clientForm->getMdp(),PASSWORD_DEFAULT));
                 $client->setUtilisateur('client');
                 $client->setNom($clientForm->getNom());
                 $client->setAdresse($clientForm->getAdresse());
                 $client->setEmail($clientForm->getEmail());
                 $client->setMdp($clientForm->getMdp());
                 $client->setCivilite($clientForm->getCivilite());
                 $em = $this->getDoctrine()->getManager();
                 $em->persist($client);
                 $em->flush();

            }
            return $this->render('owa/inscription.html.twig',array('formInscription'=>$formInscription->createView(),'form'=>$form->createView()));
 }

}
