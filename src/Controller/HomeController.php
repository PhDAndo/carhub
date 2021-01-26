<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\ProduitRepository;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
        try {
            return new Response($this->twig->render('page/home.html.twig', [
                'produits' => $produits
            ]));
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
        }
    }

}