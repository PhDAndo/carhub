<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProduitRepository;


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

    public function edit()
    {
        
    }

}