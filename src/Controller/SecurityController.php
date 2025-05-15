<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // Represents an HTTP request.
use Symfony\Component\HttpFoundation\JsonResponse; // Represents a JSON response.
use Symfony\Component\HttpFoundation\Response; // Represents an HTTP response.
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // For hashing passwords
use Symfony\Component\Routing\Annotation\Route; // For defining routes via attributes

class SecurityController extends AbstractController
{
    // In a real Symfony app, login POST is often handled by the security system itself.
    // This login method would primarily be for displaying the form (GET) or if you have custom POST logic.
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request, UtilisateurRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;

            if (!$email || !$password) {
                return new JsonResponse(['success' => false, 'message' => 'Email ou mot de passe manquant.'], Response::HTTP_BAD_REQUEST);
            }

            $user = $userRepository->findOneBy(['email' => $email]);

            if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
                return new JsonResponse(['success' => false, 'message' => 'Email ou mot de passe incorrect.'], Response::HTTP_UNAUTHORIZED);
            }
            
            // Manually starting session here is not typical for Symfony; security component handles it.
            // For demonstration, we'll simulate success and user data.
            // $request->getSession()->set('user_id', $user->getId()); 

            return new JsonResponse([
                'success' => true, 
                'message' => 'Connexion réussie!', 
                'user' => ['username' => $user->getUsername(), 'email' => $user->getEmail()]
            ]);
        }
        // For GET request, render the login form
        return $this->render('connexion.html.twig');
    }

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, UtilisateurRepository $userRepository): Response
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $username = $data['username'] ?? null;
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;

            if (!$username || !$email || !$password) {
                return new JsonResponse(['success' => false, 'message' => 'Données manquantes.'], Response::HTTP_BAD_REQUEST);
            }

            if ($userRepository->findOneBy(['email' => $email]) || $userRepository->findOneBy(['username' => $username])){
                 return new JsonResponse(['success' => false, 'message' => 'Ce nom d\'utilisateur ou email existe déjà.'], Response::HTTP_CONFLICT);
            }

            $user = new Utilisateur();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($passwordHasher->hashPassword($user, $password));
            // Roles are set by default in Utilisateur constructor

            $em->persist($user);
            $em->flush();

            return new JsonResponse(['success' => true, 'message' => 'Inscription réussie!'], Response::HTTP_CREATED);
        }
        return $this->render('inscription.html.twig');
    }

    #[Route('/logout', name: 'app_logout', methods: ['POST'])] // Symfony often handles logout via security config
    public function logout(Request $request): JsonResponse
    {
        // In a typical Symfony setup, the security component handles session invalidation for logout.
        // This action might not even be hit if firewall is configured for logout path.
        // Forcing session clear for API-like behavior if needed:
        // $session = $request->getSession();
        // $session->invalidate();
        return new JsonResponse(['success' => true, 'message' => 'Déconnexion réussie.']);
    }
}
