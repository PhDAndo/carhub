<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;


class ProduitController extends AbstractController
{

    /**
     * @var ProduitRepository
     */

    private $repository;

    public function __construct(ProduitRepository $repository, EntityManagerInterface $em)
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

    /**
     * @param produit $produit
     * @param string $slug
     * @return Response
     * @Route("/produit/{slug} - {id}", name="produit.show")
     */
    public function show(produit $produit, string $slug): Response
    {
        if ($produit->getSlug() !== $slug) {
            return $this->redirectToRoute('produit.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'current_menu' => 'produit'
        ]);
    }
}