<?php
header('Content-Type: application/json');
// session_start(); // Uncomment if you need to check for logged-in user

// require_once __DIR__ . '/src/Entity/Produit.php'; // If using the entity class

// Check if user is authenticated (example)
// if (!isset($_SESSION['user_id'])) {
//     http_response_code(403); // Forbidden
//     echo json_encode(['success' => false, 'message' => 'Accès non autorisé. Veuillez vous connecter.']);
//     exit;
// }

$data = json_decode(file_get_contents('php://input'), true);

$nom = $data['nom'] ?? null;
$description = $data['description'] ?? null;
$prix = $data['prix'] ?? null;
$quantite = $data['quantite'] ?? null;

if (!$nom || $prix === null || $quantite === null) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Données produit manquantes (nom, prix, quantité sont requis).']);
    exit;
}

// --- Database Interaction (Placeholder) ---
// 1. Connect to your database
// $pdo = new PDO('mysql:host=localhost;dbname=your_db', 'user', 'pass');

// 2. Create a new Produit entity instance (if using the class)
// $produit = new App\Entity\Produit();
// $produit->setNom($nom);
// $produit->setDescription($description);
// $produit->setPrix((float)$prix);
// $produit->setQuantite((int)$quantite);

// 3. Prepare and execute insert statement
// $stmt = $pdo->prepare('INSERT INTO produits (nom, description, prix, quantite) VALUES (:nom, :description, :prix, :quantite)');
// $success = $stmt->execute([
//     'nom' => $produit->getNom(), // or directly $nom
//     'description' => $produit->getDescription(), // or directly $description
//     'prix' => $produit->getPrix(), // or directly (float)$prix
//     'quantite' => $produit->getQuantite() // or directly (int)$quantite
// ]);
// --- End Database Interaction (Placeholder) ---

$simulatedSuccess = true; // Change to $success after implementing DB logic

if ($simulatedSuccess) {
    http_response_code(201); // Created
    echo json_encode(['success' => true, 'message' => 'Produit ajouté avec succès!']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur du serveur lors de l\'ajout du produit.']);
}
?> 