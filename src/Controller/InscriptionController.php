<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class InscriptionController extends Controller
{
  /**
   * @Route("/siteCom/inscription", name="inscription")
   */
 public function inscrire(Request $request)
 {
   global $client,$clientForm;
   $client = new Client();
   $form = $this->createFormBuilder($client)
          ->add('nom', TextType::class)
          ->add('adresse', TextType::class)
          ->add('email', EmailType::class)
          ->add('mdp', TextType::class)
          ->add('civilite', ChoiceType::class, array('choices'=>array(
            'Homme' => 'homme',
            'Femme' => 'femme'
          )))
          ->add('save', SubmitType::class, array('label' => 'incription'))
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
            return $this->render('siteCom/inscription.html.twig',array('form'=>$form->createView(),));
 }

}
