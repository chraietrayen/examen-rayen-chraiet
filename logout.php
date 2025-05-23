<?php
header('Content-Type: application/json');
session_start(); // Access the existing session

// Unset all of the session variables
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Déconnexion réussie.']);
?> 