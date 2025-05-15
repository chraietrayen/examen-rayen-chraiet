<?php
header('Content-Type: application/json');

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? null;
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;

if (!$username || !$email || !$password) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
    exit;
}

// --- Database Interaction (Placeholder) ---
// 1. Connect to your database (e.g., MySQL, PostgreSQL, SQLite)
// $pdo = new PDO('mysql:host=localhost;dbname=your_db', 'user', 'pass');

// 2. Check if username or email already exists
// $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username OR email = :email');
// $stmt->execute(['username' => $username, 'email' => $email]);
// if ($stmt->fetch()) {
//     http_response_code(409); // Conflict
//     echo json_encode(['success' => false, 'message' => 'Ce nom d\'utilisateur ou email existe déjà.']);
//     exit;
// }

// 3. Hash the password (NEVER store plain text passwords)
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 4. Insert the new user
// $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
// $success = $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);
// --- End Database Interaction (Placeholder) ---

// For this example, we'll simulate success if the above checks pass hypothetically
$simulatedSuccess = true; // Change to $success after implementing DB logic

if ($simulatedSuccess) {
    http_response_code(201); // Created
    echo json_encode(['success' => true, 'message' => 'Inscription réussie!']);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'Erreur du serveur lors de l\'inscription.']);
}
?> 