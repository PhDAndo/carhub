<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\ProduitRepository;

class HomeController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this -> twig = $twig;
    }

    /**
     * @param ProduitRepository $repository
     * @return Response
     */
    public function index(ProduitRepository $repository): Response
    {
        $produits = $repository->findLatest();
        return new Response($this->twig->render('page/home.html.twig', [
            'produits'=>$produits
        ]));
    }

}