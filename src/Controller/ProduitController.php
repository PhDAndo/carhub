<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Repository\ProduitRepository;


class ProduitController extends AbstractController
{

    /**
     * @var ProduitRepository
     */

    private $repository;

    public function __construct(ProduitRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Response
     */

    public function index(): Response
    {        
        return $this->render('produit/index.html.twig', [
            'current_menu' => 'produit'
        ]);
    }

}