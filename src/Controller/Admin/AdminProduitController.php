<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AdminType;


class AdminProduitController extends AbstractController 
{
    
    /**
     * @var ProduitRepository
     */

    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ProduitRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
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
     * @Route ("/admin/produit/create", name="admin.produit.new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $produit = new produit();
        $form = $this->createForm(AdminType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($produit);
            $this->em->flush();
            $this->addFlash('success', 'Créé avec succès');
            return $this->redirectToRoute('admin.produit.index');
        }

        return $this->render('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/produit/{id}", name="admin.produit.edit", methods="GET|POST")
     * @param produit $produit
     * @param Request $request
     * @return Response
     */
    public function edit(produit $produit, Request $request): Response
    {
        $form = $this->createForm(AdminType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Modifié avec succès');
            return $this->redirectToRoute('admin.produit.index');
        }

        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/produit/{id}", name="admin.produit.delete", methods="DELETE")
     * @param Produit $produit
     * @param Request $request
     * @return Response
     */
    public function delete(produit $produit, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->get('_token'))){
            $this->em->remove($produit);
            $this->em->flush();
            $this->addFlash('success', 'Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.produit.index');
    }

}