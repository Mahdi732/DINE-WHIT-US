<?php
/**
 * Add Menu Handler - Admin Only
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
$menu_name = Security::sanitize($_POST['name'] ?? '');
$plats = $_POST['plats'] ?? [];
$id_chef = $_SESSION['user_id'];

// Validate input
if (empty($menu_name)) {
    Security::redirect('admin.php', 'Le nom du menu est requis.', 'error');
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
    $file_name = uniqid('menu_') . '.' . $extension;
    $target_file = $upload_dir . $file_name;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = 'uploads/' . $file_name;
    } else {
        Security::redirect('admin.php', 'Erreur lors du téléchargement de l\'image.', 'error');
    }
}

try {
    // Begin transaction
    Database::beginTransaction();
    
    // Insert menu
    Database::execute(
        "INSERT INTO menus (id_chef, nom_menu, image_menu) VALUES (?, ?, ?)",
        [$id_chef, $menu_name, $image_path]
    );
    
    $menu_id = Database::lastInsertId();
    
    // Associate dishes with menu if any
    if (!empty($plats) && $menu_id) {
        foreach ($plats as $plat_id) {
            $plat_id = (int)$plat_id;
            if ($plat_id > 0) {
                Database::execute(
                    "UPDATE plats SET id_menu = ? WHERE id_plat = ?",
                    [$menu_id, $plat_id]
                );
            }
        }
    }
    
    // Commit transaction
    Database::commit();
    
    Security::redirect('admin.php', 'Menu créé avec succès!', 'success');
    
} catch (Exception $e) {
    Database::rollback();
    error_log("Add menu error: " . $e->getMessage());
    Security::redirect('admin.php', 'Une erreur est survenue. Veuillez réessayer.', 'error');
}

