<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

 class PanierController extends Controller{
    /**
    * @Route("/panier", name="siteCom")
   */
        public function panier(){
        /* Démarrage ou prolongation de la session */
        session_start();
       
        /* Article exemple */
        $select = array();
        $select['id'] = "phlevis501";
        $select['qte'] = 2;
        $select['taille'] = "56";
        $select['prix'] = 84.95;

        /* On vérifie l'existence du panier, sinon, on le crée */
        if(!isset($_SESSION['panier']))
        {
            /* Initialisation du panier */
            $_SESSION['panier'] = array();
            /* Subdivision du panier */
            $_SESSION['panier']['id_article'] = array();
            $_SESSION['panier']['qte'] = array();
            $_SESSION['panier']['taille'] = array();
            $_SESSION['panier']['prix'] = array();
        }

        /* Ici, on sait que le panier existe, donc on ajoute l'article dedans. */
       // array_push($_SESSION['panier']['id_article'],$select['id']);
        array_push($_SESSION['panier']['qte'],$select['qte']);
        array_push($_SESSION['panier']['taille'],$select['taille']);
        array_push($_SESSION['panier']['prix'],$select['prix']);

        /* Affichons maintenant le contenu du panier : */
        
       echo '<pre>';
        
        var_dump($_SESSION['panier']);
        
        echo '</pre>';

            return new response('<html><body>Lucky number: '.'henrick'.'</body></html>');     
        }
}