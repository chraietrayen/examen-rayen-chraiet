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

// --- Database Interaction (Placeholder) ---
// 1. Connect to your database
// $pdo = new PDO('mysql:host=localhost;dbname=your_db', 'user', 'pass');

// 2. Fetch all produits
// $stmt = $pdo->query('SELECT id, nom, description, prix, quantite FROM produits ORDER BY nom ASC');
// $produitsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
// --- End Database Interaction (Placeholder) ---

// Simulated data for example purposes
$simulatedProduitsData = [
    ['id' => 1, 'nom' => 'Produit Alpha', 'description' => 'Description pour Alpha', 'prix' => 19.99, 'quantite' => 100],
    ['id' => 2, 'nom' => 'Produit Beta', 'description' => 'Description pour Beta', 'prix' => 25.50, 'quantite' => 50],
    ['id' => 3, 'nom' => 'Produit Gamma', 'description' => 'Description pour Gamma', 'prix' => 9.75, 'quantite' => 200],
];

// In a real scenario, use $produitsData from the database
if (isset($simulatedProduitsData)) { // Change to $produitsData when DB is implemented
    echo json_encode(['success' => true, 'produits' => $simulatedProduitsData]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur du serveur lors de la récupération des produits.']);
}
?> 