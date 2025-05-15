<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')] // Or #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        // This page might require authentication in a real app
        // $this->denyAccessUnlessGranted('ROLE_USER');
        
        // You can pass data to the Twig template if needed
        // $user = $this->getUser(); // Gets the currently authenticated user
        return $this->render('accueil.html.twig', [
            // 'controller_name' => 'MainController',
            // 'currentUser' => $user ? ['username' => $user->getUsername(), 'email' => $user->getEmail()] : null,
        ]);
    }
} 