<?php
/**
 * Admin Dashboard - Modern & Optimized
 */
$pageTitle = 'Admin Dashboard - Victory Restaurant';
require_once __DIR__ . '/config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check admin access
if (!Security::isLoggedIn() || !Security::isAdmin()) {
    Security::redirect('login.php', 'Accès non autorisé.', 'error');
}

// Get current user
$user = User::getCurrentUser();

// Get statistics with optimized queries
$stats = [
    'menus' => Database::queryOne("SELECT COUNT(*) as total FROM menus")['total'] ?? 0,
    'plats' => Database::queryOne("SELECT COUNT(*) as total FROM plats")['total'] ?? 0,
    'clients' => Database::queryOne("SELECT COUNT(*) as total FROM client")['total'] ?? 0,
    'reservations' => Database::queryOne("SELECT COUNT(*) as total FROM reservations")['total'] ?? 0,
    'pending' => Database::queryOne("SELECT COUNT(*) as total FROM reservations WHERE statut = 'en attente'")['total'] ?? 0,
    'approved' => Database::queryOne("SELECT COUNT(*) as total FROM reservations WHERE statut = 'approuvée'")['total'] ?? 0,
];

// Get recent reservations
$reservations = Database::query("
    SELECT r.id_reservation, c.nom AS client_name, c.prenom AS client_surname, 
           m.nom_menu, r.date_reservation, r.heure_reservation, 
           r.nombre_personnes, r.statut,
           COALESCE(SUM(p.prix), 0) AS total_price
    FROM reservations r
    JOIN client c ON r.id_client = c.id_client
    JOIN menus m ON r.id_menu = m.id_menu
    LEFT JOIN plats p ON m.id_menu = p.id_menu
    WHERE r.statut IN ('en attente', 'approuvée', 'refusée')
    GROUP BY r.id_reservation
    ORDER BY r.date_reservation DESC, r.heure_reservation DESC
    LIMIT 20
");

// Get menus
$menus = Database::query("SELECT * FROM menus ORDER BY id_menu DESC");

// Get dishes without menu for selection
$availableDishes = Database::query("SELECT id_plat, nom_plat FROM plats");

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'], $_POST['status'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $new_status = Security::sanitize($_POST['status']);
    $valid_statuses = ['en attente', 'approuvée', 'refusée'];
    
    if (in_array($new_status, $valid_statuses)) {
        Database::execute(
            "UPDATE reservations SET statut = ? WHERE id_reservation = ?",
            [$new_status, $reservation_id]
        );
        Security::redirect('admin.php', 'Statut mis à jour avec succès!', 'success');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': {
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                        },
                        'dark': {
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        },
                        'surface': '#16213e',
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'body': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); }
        .gradient-text { background: linear-gradient(135deg, #f97316, #fb923c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    </style>
</head>
<body class="bg-dark-950 text-gray-100 font-body">
    <!-- Flash Messages -->
    <?php if ($flashMessage = Security::getFlashMessage()): ?>
    <div id="flash-message" class="fixed top-4 right-4 z-50 animate-pulse">
        <div class="px-6 py-4 rounded-xl shadow-2xl <?php echo $flashMessage['type'] === 'error' ? 'bg-red-500' : 'bg-green-500'; ?> text-white">
            <?php echo Security::sanitize($flashMessage['text']); ?>
        </div>
    </div>
    <script>setTimeout(() => document.getElementById('flash-message')?.remove(), 3000);</script>
    <?php endif; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 glass fixed left-0 top-0 h-full z-30">
            <div class="p-6">
                <!-- Logo -->
                <a href="index.php" class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center">
                        <span class="text-white font-display font-bold">V</span>
                    </div>
                    <span class="text-xl font-display font-bold text-white">Victory</span>
                </a>
                
                <!-- User Info -->
                <div class="flex items-center gap-3 p-4 rounded-xl bg-white/5 mb-8">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">
                            <?php echo strtoupper(substr($user['prenom'] ?? 'A', 0, 1)); ?>
                        </span>
                    </div>
                    <div>
                        <div class="text-white font-medium text-sm"><?php echo Security::sanitize($user['nom'] . ' ' . $user['prenom']); ?></div>
                        <div class="text-gray-500 text-xs">Administrateur</div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="admin.php" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-500/20 text-brand-400 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                    <a href="index.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-white/5 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Site Web
                    </a>
                    <a href="menu.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-white/5 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Voir Menus
                    </a>
                </nav>
                
                <!-- Logout -->
                <div class="absolute bottom-6 left-6 right-6">
                    <form action="logout.php" method="post">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-display font-bold text-white mb-2">Tableau de Bord</h1>
                    <p class="text-gray-400">Bienvenue, <?php echo Security::sanitize($user['prenom']); ?>. Voici un aperçu de votre restaurant.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="document.getElementById('addplatform').classList.remove('hidden')" class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all font-medium">
                        + Nouveau Plat
                    </button>
                    <button onclick="document.getElementById('addmenuform').classList.remove('hidden')" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-500 to-brand-600 text-white font-medium hover:shadow-lg hover:shadow-brand-500/25 transition-all">
                        + Nouveau Menu
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <span class="text-green-400 text-sm font-medium">+12%</span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1"><?php echo $stats['menus']; ?></h3>
                    <p class="text-gray-400 text-sm">Total Menus</p>
                </div>
                
                <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="text-green-400 text-sm font-medium">+8%</span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1"><?php echo $stats['plats']; ?></h3>
                    <p class="text-gray-400 text-sm">Total Plats</p>
                </div>
                
                <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-green-400 text-sm font-medium">+24%</span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1"><?php echo $stats['clients']; ?></h3>
                    <p class="text-gray-400 text-sm">Clients</p>
                </div>
                
                <div class="glass rounded-2xl p-6 hover:bg-white/10 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-yellow-400 text-sm font-medium"><?php echo $stats['pending']; ?> en attente</span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1"><?php echo $stats['reservations']; ?></h3>
                    <p class="text-gray-400 text-sm">Réservations</p>
                </div>
            </div>

            <!-- Reservations Table -->
            <div class="glass rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">Réservations Récentes</h2>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400 text-xs font-medium"><?php echo $stats['pending']; ?> en attente</span>
                        <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400 text-xs font-medium"><?php echo $stats['approved']; ?> approuvées</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-white/10">
                                <th class="pb-4 text-gray-400 font-medium text-sm">ID</th>
                                <th class="pb-4 text-gray-400 font-medium text-sm">Client</th>
                                <th class="pb-4 text-gray-400 font-medium text-sm">Menu</th>
                                <th class="pb-4 text-gray-400 font-medium text-sm">Date & Heure</th>
                                <th class="pb-4 text-gray-400 font-medium text-sm">Personnes</th>
                                <th class="pb-4 text-gray-400 font-medium text-sm">Prix</th>
                                <th class="pb-4 text-gray-400 font-medium text-sm">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if (!empty($reservations)): ?>
                                <?php foreach ($reservations as $row): ?>
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="py-4 text-white font-medium">#<?php echo $row['id_reservation']; ?></td>
                                    <td class="py-4 text-gray-300"><?php echo Security::sanitize($row['client_name'] . ' ' . $row['client_surname']); ?></td>
                                    <td class="py-4 text-gray-300"><?php echo Security::sanitize($row['nom_menu']); ?></td>
                                    <td class="py-4 text-gray-400">
                                        <?php echo date('d/m/Y', strtotime($row['date_reservation'])); ?>
                                        <span class="text-brand-400"><?php echo $row['heure_reservation']; ?></span>
                                    </td>
                                    <td class="py-4 text-gray-300"><?php echo $row['nombre_personnes']; ?></td>
                                    <td class="py-4 text-brand-400 font-semibold"><?php echo number_format($row['total_price'], 2); ?>€</td>
                                    <td class="py-4">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="reservation_id" value="<?php echo $row['id_reservation']; ?>">
                                            <select name="status" onchange="this.form.submit()" 
                                                class="px-3 py-1.5 rounded-lg text-sm font-medium border-0 cursor-pointer
                                                <?php 
                                                    echo match($row['statut']) {
                                                        'approuvée' => 'bg-green-500/20 text-green-400',
                                                        'refusée' => 'bg-red-500/20 text-red-400',
                                                        default => 'bg-yellow-500/20 text-yellow-400'
                                                    };
                                                ?>">
                                                <option value="en attente" <?php echo $row['statut'] === 'en attente' ? 'selected' : ''; ?> class="bg-dark-900">En attente</option>
                                                <option value="approuvée" <?php echo $row['statut'] === 'approuvée' ? 'selected' : ''; ?> class="bg-dark-900">Approuvée</option>
                                                <option value="refusée" <?php echo $row['statut'] === 'refusée' ? 'selected' : ''; ?> class="bg-dark-900">Refusée</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-gray-500">Aucune réservation trouvée.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Menus Grid -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-white mb-6">Vos Menus</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($menus as $menu): ?>
                    <div class="glass rounded-2xl overflow-hidden group hover:bg-white/10 transition-all">
                        <div class="h-40 bg-gradient-to-br from-brand-500/20 to-purple-500/20 flex items-center justify-center">
                            <?php if ($menu['image_menu']): ?>
                                <img src="<?php echo Security::sanitize($menu['image_menu']); ?>" alt="" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span class="text-4xl">🍽️</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-white mb-2"><?php echo Security::sanitize($menu['nom_menu']); ?></h3>
                            <p class="text-gray-400 text-sm mb-4"><?php echo Security::sanitize($menu['description'] ?? 'Menu sans description'); ?></p>
                            <div class="flex items-center justify-between">
                                <span class="text-brand-400 text-sm font-medium">
                                    <?php 
                                    $dishCount = Database::queryOne("SELECT COUNT(*) as cnt FROM plats WHERE id_menu = ?", [$menu['id_menu']]);
                                    echo ($dishCount['cnt'] ?? 0) . ' plats';
                                    ?>
                                </span>
                                <form action="dishes.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce menu?');">
                                    <input type="hidden" name="delete" value="<?php echo $menu['id_menu']; ?>">
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <?php if (empty($menus)): ?>
                    <div class="col-span-full glass rounded-2xl p-12 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-brand-500/10 flex items-center justify-center">
                            <svg class="w-8 h-8 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Aucun menu</h3>
                        <p class="text-gray-400 text-sm">Créez votre premier menu pour commencer.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Menu Modal -->
    <div id="addmenuform" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70" onclick="this.parentElement.classList.add('hidden')"></div>
        <div class="relative glass rounded-2xl max-w-md w-full p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">Nouveau Menu</h2>
                <button onclick="document.getElementById('addmenuform').classList.add('hidden')" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <form method="POST" action="addmenu.php" enctype="multipart/form-data" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Image du Menu</label>
                    <label class="flex items-center justify-center w-full h-32 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-brand-500/50 transition-colors">
                        <div class="text-center">
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            <span class="text-sm text-gray-400">Choisir une image</span>
                        </div>
                        <input type="file" name="image" accept="image/*" class="hidden">
                    </label>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nom du Menu</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors" placeholder="Ex: Menu Découverte">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Plats associés</label>
                    <div class="max-h-40 overflow-y-auto space-y-2 p-3 rounded-xl bg-white/5 border border-white/10">
                        <?php foreach ($availableDishes as $dish): ?>
                        <label class="flex items-center gap-3 cursor-pointer hover:bg-white/5 p-2 rounded-lg transition-colors">
                            <input type="checkbox" name="plats[]" value="<?php echo $dish['id_plat']; ?>" class="rounded border-white/20 bg-white/5 text-brand-500">
                            <span class="text-gray-300 text-sm"><?php echo Security::sanitize($dish['nom_plat']); ?></span>
                        </label>
                        <?php endforeach; ?>
                        <?php if (empty($availableDishes)): ?>
                        <p class="text-gray-500 text-sm text-center py-2">Aucun plat disponible</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-brand-500 to-brand-600 text-white font-semibold hover:shadow-lg hover:shadow-brand-500/25 transition-all">
                    Créer le Menu
                </button>
            </form>
        </div>
    </div>

    <!-- Add Dish Modal -->
    <div id="addplatform" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70" onclick="this.parentElement.classList.add('hidden')"></div>
        <div class="relative glass rounded-2xl max-w-md w-full p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">Nouveau Plat</h2>
                <button onclick="document.getElementById('addplatform').classList.add('hidden')" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <form method="POST" action="addplat.php" enctype="multipart/form-data" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Image du Plat</label>
                    <label class="flex items-center justify-center w-full h-32 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-brand-500/50 transition-colors">
                        <div class="text-center">
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            <span class="text-sm text-gray-400">Choisir une image</span>
                        </div>
                        <input type="file" name="image" accept="image/*" class="hidden" required>
                    </label>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nom du Plat</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors" placeholder="Ex: Poulet Rôti">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Prix (€)</label>
                    <input type="number" name="price" step="0.01" min="0" required class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors" placeholder="0.00">
                </div>
                
                <input type="hidden" name="id_menu" value="1">
                
                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-brand-500 to-brand-600 text-white font-semibold hover:shadow-lg hover:shadow-brand-500/25 transition-all">
                    Ajouter le Plat
                </button>
            </form>
        </div>
    </div>
</body>
</html>
