<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Fournisseur;
use App\Entity\Achat;

class CompteController extends Controller
{
    /**
     * @Route("/siteCom/compte", name="compte")
     */
    public function index()
    {
            return new response('comte');
    }

}
