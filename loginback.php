<?php
/**
 * Login Handler - Secure Authentication
 */
require_once __DIR__ . '/config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::redirect('login.php');
}

// Verify CSRF token
if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
    Security::redirect('login.php', 'Session expirée. Veuillez réessayer.', 'error');
}

// Get and sanitize input
$email = Security::sanitize($_POST['email_login'] ?? '');
$password = $_POST['password_login'] ?? '';

// Validate input
if (empty($email) || empty($password)) {
    Security::redirect('login.php', 'Veuillez remplir tous les champs.', 'error');
}

if (!Security::validateEmail($email)) {
    Security::redirect('login.php', 'Adresse email invalide.', 'error');
}

try {
    // Get user by email
    $user = User::getByEmail($email);
    
    if (!$user) {
        // Use generic message to prevent email enumeration
        Security::redirect('login.php', 'Email ou mot de passe incorrect.', 'error');
    }
    
    // Verify password
    if (!password_verify($password, $user['mot_de_passe'])) {
        Security::redirect('login.php', 'Email ou mot de passe incorrect.', 'error');
    }
    
    // Regenerate session ID to prevent session fixation
    session_regenerate_id(true);
    
    // Set session variables
    $_SESSION['user_id'] = $user['id_client'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['nom'] . ' ' . $user['prenom'];
    
    // Check if admin (use a proper role system in production)
    $isAdmin = strtolower($email) === 'admin@gmail.com';
    $_SESSION['is_admin'] = $isAdmin;
    
    // Set login timestamp
    $_SESSION['login_time'] = time();
    
    // Redirect based on role
    if ($isAdmin) {
        Security::redirect('admin.php', 'Bienvenue, Admin!', 'success');
    } else {
        Security::redirect('user.php', 'Connexion réussie!', 'success');
    }
    
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    Security::redirect('login.php', 'Une erreur est survenue. Veuillez réessayer.', 'error');
}

