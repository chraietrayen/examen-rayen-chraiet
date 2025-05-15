<?php
header('Content-Type: application/json');
session_start(); // Start session for real session management

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'] ?? null;
$password = $data['password'] ?? null;

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email ou mot de passe manquant.']);
    exit;
}

// --- Database Interaction (Placeholder) ---
// 1. Connect to your database
// $pdo = new PDO('mysql:host=localhost;dbname=your_db', 'user', 'pass');

// 2. Fetch user by email
// $stmt = $pdo->prepare('SELECT id, username, email, password FROM users WHERE email = :email');
// $stmt->execute(['email' => $email]);
// $user = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Verify password (use password_verify with hashed password from DB)
// if ($user && password_verify($password, $user['password'])) {
//     // Password is correct
//     $_SESSION['user_id'] = $user['id']; // Store user ID in session
//     $_SESSION['username'] = $user['username'];
//     http_response_code(200);
//     echo json_encode([
//         'success' => true, 
//         'message' => 'Connexion réussie!', 
//         'user' => ['username' => $user['username'], 'email' => $user['email']] // Send some user data back
//     ]);
// } else {
//     // Invalid credentials
//     http_response_code(401); // Unauthorized
//     echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);
// }
// --- End Database Interaction (Placeholder) ---

// Simulated successful login for example purposes (if email contains '@' and password is not empty)
if (strpos($email, '@') !== false && !empty($password)) {
    $_SESSION['user_id'] = 1; // Simulated user ID
    $_SESSION['username'] = 'UtilisateurTest';
    http_response_code(200);
    echo json_encode([
        'success' => true, 
        'message' => 'Connexion réussie (simulation)!',
        'user' => ['username' => 'UtilisateurTest', 'email' => $email]
    ]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect (simulation).']);
}

?> 