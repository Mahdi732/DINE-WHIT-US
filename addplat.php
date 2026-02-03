<?php
/**
 * Add Dish Handler - Admin Only
 */
require_once __DIR__ . '/config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check admin access
if (!Security::isLoggedIn() || !Security::isAdmin()) {
    Security::redirect('login.php', 'Accès non autorisé.', 'error');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::redirect('admin.php');
}

// Get and sanitize input
$name = Security::sanitize($_POST['name'] ?? '');
$price = (float)($_POST['price'] ?? 0);
$id_menu = (int)($_POST['id_menu'] ?? 1);
$id_chef = $_SESSION['user_id'];

// Validate input
if (empty($name)) {
    Security::redirect('admin.php', 'Le nom du plat est requis.', 'error');
}

if ($price <= 0) {
    Security::redirect('admin.php', 'Le prix doit être supérieur à 0.', 'error');
}

// Handle image upload
$image_path = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = __DIR__ . '/uploads/';
    
    // Create directory if not exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Validate file type
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $file_type = mime_content_type($_FILES['image']['tmp_name']);
    
    if (!in_array($file_type, $allowed_types)) {
        Security::redirect('admin.php', 'Type de fichier non autorisé. Utilisez JPG, PNG, GIF ou WebP.', 'error');
    }
    
    // Validate file size (max 5MB)
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        Security::redirect('admin.php', 'Le fichier est trop volumineux. Maximum 5MB.', 'error');
    }
    
    // Generate unique filename
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $file_name = uniqid('plat_') . '.' . $extension;
    $target_file = $upload_dir . $file_name;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = '/uploads/' . $file_name;
    } else {
        Security::redirect('admin.php', 'Erreur lors du téléchargement de l\'image.', 'error');
    }
} else {
    Security::redirect('admin.php', 'L\'image est requise.', 'error');
}

try {
    Database::execute(
        "INSERT INTO plats (nom_plat, prix, image, id_menu) VALUES (?, ?, ?, ?)",
        [$name, $price, $image_path, $id_menu]
    );
    
    Security::redirect('admin.php', 'Plat ajouté avec succès!', 'success');
    
} catch (Exception $e) {
    error_log("Add dish error: " . $e->getMessage());
    Security::redirect('admin.php', 'Une erreur est survenue. Veuillez réessayer.', 'error');
}

