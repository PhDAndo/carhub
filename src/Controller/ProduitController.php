<?php

namespace App\Controller;

use App\Entity\Command;
use App\Form\CommandType;
use App\Notification\CommandNotification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */

    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $produit = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('produit/index.html.twig', [
            'current_menu' => 'produit',
            'produit' => $produit
        ]);
    }

    /**
     * @param produit $produit
     * @param string $slug
     * @param Request $request
     * @param CommandNotification $notification
     * @return Response
     * @Route("/produit/{slug} - {id}", name="produit.show")
     */
    public function show(produit $produit, string $slug, Request $request, CommandNotification $notification): Response
    {
        if ($produit->getSlug() !== $slug) {
            return $this->redirectToRoute('produit.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }

        $command = new Command();
        $command->setProduit($produit);
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($command);
            $this->addFlash('success', 'Votre commande a été bien envoyé');
            return $this->redirectToRoute('produit.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ]);
        }

        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'current_menu' => 'produit',
            'form' => $form->createView()
        ]);
    }
}