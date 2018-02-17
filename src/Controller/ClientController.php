<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Client;

class ClientController extends Controller
{
    
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $client->setNom('Franck');
        $client->setAdresse('Keyboard');
        $client->setEmail('dazd@dazd.com');
        $client->setMdp('Keyboard');
        $client->setCivilite(1);
        $em->persist($client);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('votre référence est '.$client->getId().'<br> votre nom est '.$client->getNom());
    }
}
