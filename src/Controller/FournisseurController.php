<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Fournisseur;
class FournisseurController extends Controller
{
    /**
     * @Route("/fournisseur", name="fournisseur")
     */
    public function index()
    {
        // replace this line with your own code!
        $em = $this->getDoctrine()->getManager();
        $fournisseur = new Fournisseur();
        $fournisseur->setNom('Fournisseur');
        $fournisseur->setAdresse('Keyboard');
        $fournisseur->setEmail('dazd@dazd.com');
        $em->persist($fournisseur);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('votre référence est '.$fournisseur->getId().'<br> votre nom est '.$fournisseur->getNom());
    
    }
}
