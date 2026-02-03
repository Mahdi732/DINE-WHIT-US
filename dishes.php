<?php
/**
 * Delete Menu Handler - Admin Only
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

$id = (int)($_POST['delete'] ?? 0);

if ($id < 1) {
    Security::redirect('admin.php', 'ID de menu invalide.', 'error');
}

try {
    // First, update dishes to remove menu association
    Database::execute("UPDATE plats SET id_menu = NULL WHERE id_menu = ?", [$id]);
    
    // Then delete the menu
    $affected = Database::execute("DELETE FROM menus WHERE id_menu = ?", [$id]);
    
    if ($affected > 0) {
        Security::redirect('admin.php', 'Menu supprimé avec succès!', 'success');
    } else {
        Security::redirect('admin.php', 'Menu non trouvé.', 'error');
    }
    
} catch (Exception $e) {
    error_log("Delete menu error: " . $e->getMessage());
    Security::redirect('admin.php', 'Une erreur est survenue. Veuillez réessayer.', 'error');
}
