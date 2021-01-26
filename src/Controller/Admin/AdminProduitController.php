<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProduitRepository;
use symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AdminType;


class AdminProduitController extends AbstractController 
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
     * @Route ("/admin", name="admin.produit.index")
     * @return Response
     */
    public function index(): Response
    {
        $produit = $this->repository->findAll();
        return $this->render('admin/produit/index.html.twig', compact('produit'));
    }

    /**
     * @Route ("/admin/{id}", name="admin.produit.edit")
     * @param produit $produit
     * @return Response
     */
    public function edit(produit $produit): Response
    {
        $form = $this->createForm(AdminType::class, $produit);
        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

}