<?php
/**
 * Reservation Handler - Secure Booking System
 */
require_once __DIR__ . '/config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!Security::isLoggedIn()) {
    Security::redirect('login.php', 'Veuillez vous connecter pour faire une réservation.', 'error');
}

// Admin cannot make reservations
if (Security::isAdmin()) {
    Security::redirect('menu.php', 'Les administrateurs ne peuvent pas faire de réservations.', 'error');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::redirect('menu.php');
}

// Verify CSRF token
if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
    Security::redirect('menu.php', 'Session expirée. Veuillez réessayer.', 'error');
}

// Get and sanitize input
$date_reservation = Security::sanitize($_POST['date_reservation'] ?? '');
$heure_reservation = Security::sanitize($_POST['heure_reservation'] ?? '');
$nom = Security::sanitize($_POST['nom'] ?? '');
$telephone = Security::sanitize($_POST['telephone'] ?? '');
$nombre_personnes = (int)($_POST['nombre_personnes'] ?? 0);
$id_menu = (int)($_POST['id_menu'] ?? 0);
$id_client = $_SESSION['user_id'];

// Validate input
$errors = [];

if (empty($date_reservation)) {
    $errors[] = 'La date de réservation est requise.';
} else {
    $reservation_date = strtotime($date_reservation);
    if ($reservation_date < strtotime('today')) {
        $errors[] = 'La date de réservation doit être dans le futur.';
    }
}

if (empty($heure_reservation)) {
    $errors[] = "L'heure de réservation est requise.";
}

if (empty($nom)) {
    $errors[] = 'Le nom est requis.';
}

if (empty($telephone)) {
    $errors[] = 'Le numéro de téléphone est requis.';
}

if ($nombre_personnes < 1 || $nombre_personnes > 20) {
    $errors[] = 'Le nombre de personnes doit être entre 1 et 20.';
}

if ($id_menu < 1) {
    $errors[] = 'Veuillez sélectionner un menu.';
}

// Check if menu exists
$menu = Database::queryOne("SELECT id_menu FROM menus WHERE id_menu = ?", [$id_menu]);
if (!$menu) {
    $errors[] = 'Le menu sélectionné est invalide.';
}

// If errors, redirect back
if (!empty($errors)) {
    Security::redirect('menu.php#reservation', implode(' ', $errors), 'error');
}

try {
    // Insert reservation
    Database::execute(
        "INSERT INTO reservations (id_client, id_menu, date_reservation, heure_reservation, nombre_personnes, statut) 
         VALUES (?, ?, ?, ?, ?, 'en attente')",
        [$id_client, $id_menu, $date_reservation, $heure_reservation, $nombre_personnes]
    );
    
    Security::redirect('user.php', 'Votre réservation a été effectuée avec succès!', 'success');
    
} catch (Exception $e) {
    error_log("Reservation error: " . $e->getMessage());
    Security::redirect('menu.php#reservation', 'Une erreur est survenue. Veuillez réessayer.', 'error');
}

