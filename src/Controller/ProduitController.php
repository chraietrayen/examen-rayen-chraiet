<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produits')] // Base route for all actions in this controller
class ProduitController extends AbstractController
{
    #[Route('/dashboard', name: 'app_produit_dashboard', methods: ['GET'])]
    public function dashboard(): Response
    {
        // This page might require authentication in a real app
        // $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('produit-dashboard.html.twig');
    }

    #[Route('/add', name: 'app_produit_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN'); // Or a specific role for adding products

        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $nom = $data['nom'] ?? null;
            $description = $data['description'] ?? null;
            $prix = $data['prix'] ?? null;
            $quantite = $data['quantite'] ?? null;

            if (!$nom || $prix === null || $quantite === null) {
                return new JsonResponse(['success' => false, 'message' => 'Données produit manquantes.'], Response::HTTP_BAD_REQUEST);
            }

            $produit = new Produit();
            $produit->setNom($nom);
            $produit->setDescription($description);
            $produit->setPrix((float)$prix);
            $produit->setQuantite((int)$quantite);

            $em->persist($produit);
            $em->flush();

            return new JsonResponse(['success' => true, 'message' => 'Produit ajouté avec succès!'], Response::HTTP_CREATED);
        }

        return $this->render('produit-add.html.twig');
    }

    #[Route('/list', name: 'app_produit_list', methods: ['GET'])]
    public function list(ProduitRepository $produitRepository): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_USER');
        $produits = $produitRepository->findAll();

        return $this->render('produit-list.html.twig', [
            'produits' => $produits,
        ]);
    }

    // You would add more actions here for edit, delete, view single product, etc.
} 