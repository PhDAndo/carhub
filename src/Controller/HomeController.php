<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

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

    public function index(ProduitRepository $repository): Response
    {
        $produit = $repository->findLatest();
        return new Response($this->twig->render('page/home.html.twig'));
    }

}