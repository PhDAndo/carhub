<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Reference;
use Twig\Environment;


class ProduitController extends AbstractController
{

    /**
     * @return Response
     */

    public function index(): Response
    {
        $produit = new produit();
        $produit->setTitre('Toyota Land Cruiser')
                ->setPrix(2000000)
                ->setDescription('véhicule tout térrain')
                ->setMarque('Toyota')
                ->setType('véhicule léger')
                ->setQuantite_stock('10')
                ->setFournisseur('Japon');

        $manage = $this->getDoctrine()->getManager();
        $manage->persist($produit);
        $manage->flush();
        return $this->render('produit/index.html.twig', [
            'current_menu' => 'produit'
        ]);
    }

}