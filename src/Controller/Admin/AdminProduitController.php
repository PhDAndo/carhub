<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\Produit;


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
     * @return \symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $produit = $this->repository->findAll();
        return $this->render('admin/produit/index.html.twig', compact('produit'));
    }

    /**
     * @Route ("/admin/{id}", name="admin.produit.edit")
     * @param Produit $produit
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ProduitRepository $produit)
    {
        return $this->render('admin/produit/edit.html.twig', compact('produit'));
    }

}