<?php
session_start();
require_once 'config/database.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id']) || isset($_SESSION['is_admin'])) {
    Security::redirect('login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user = User::getById($user_id);

// Get user's reservations
$reservations = Database::query(
    "SELECT * FROM reservations WHERE user_id = ? ORDER BY date DESC, time DESC",
    [$user_id]
);

// Calculate stats
$total_reservations = count($reservations);
$approved_count = count(array_filter($reservations, fn($r) => ($r['status'] ?? 'pending') === 'approved'));
$pending_count = count(array_filter($reservations, fn($r) => ($r['status'] ?? 'pending') === 'pending'));

// Get user initials for avatar
$initials = '';
if ($user) {
    $names = explode(' ', $user['nom'] ?? '');
    foreach ($names as $name) {
        $initials .= strtoupper(substr($name, 0, 1));
    }
    $initials = substr($initials, 0, 2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Dine With Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'serif': ['Playfair Display', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); }
    </style>
</head>
<body class="bg-slate-950 text-white min-h-screen font-sans">
    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="index.php" class="font-serif text-2xl font-bold text-brand-500">Dine With Us</a>
                <div class="flex items-center gap-4">
                    <a href="menu.php" class="text-gray-300 hover:text-white transition">Menu</a>
                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg transition">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="font-serif text-4xl font-bold mb-2">My Profile</h1>
            <p class="text-gray-400">Manage your account and view your reservations</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="glass rounded-2xl p-6 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-brand-500 to-brand-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-bold">
                        <?php echo $initials ?: 'U'; ?>
                    </div>
                    <h2 class="text-xl font-semibold mb-1"><?php echo htmlspecialchars($user['nom'] ?? 'User'); ?></h2>
                    <p class="text-gray-400 mb-6"><?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-6 border-t border-white/10">
                        <div>
                            <div class="text-2xl font-bold text-brand-500"><?php echo $total_reservations; ?></div>
                            <div class="text-xs text-gray-400">Total</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-green-500"><?php echo $approved_count; ?></div>
                            <div class="text-xs text-gray-400">Approved</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-yellow-500"><?php echo $pending_count; ?></div>
                            <div class="text-xs text-gray-400">Pending</div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="glass rounded-2xl p-6 mt-6">
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <div class="space-y-3">
                        <a href="menu.php" class="flex items-center gap-3 text-gray-300 hover:text-white transition p-2 rounded-lg hover:bg-white/5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            View Menu
                        </a>
                        <a href="index.php#reservation" class="flex items-center gap-3 text-gray-300 hover:text-white transition p-2 rounded-lg hover:bg-white/5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Make Reservation
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reservations -->
            <div class="lg:col-span-2">
                <div class="glass rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h2 class="text-xl font-semibold">My Reservations</h2>
                    </div>
                    
                    <?php if (empty($reservations)): ?>
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-400 mb-4">You haven't made any reservations yet</p>
                        <a href="index.php#reservation" class="inline-block bg-brand-600 hover:bg-brand-700 px-6 py-3 rounded-xl transition">
                            Book a Table
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="divide-y divide-white/10">
                        <?php foreach ($reservations as $res): 
                            $status = $res['status'] ?? 'pending';
                            $statusClasses = [
                                'pending' => 'bg-yellow-500/20 text-yellow-400',
                                'approved' => 'bg-green-500/20 text-green-400',
                                'rejected' => 'bg-red-500/20 text-red-400',
                            ];
                            $statusClass = $statusClasses[$status] ?? $statusClasses['pending'];
                        ?>
                        <div class="p-6 hover:bg-white/5 transition">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="text-lg font-semibold"><?php echo htmlspecialchars($res['name']); ?></span>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo $statusClass; ?>">
                                            <?php echo ucfirst($status); ?>
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-4 text-sm text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <?php echo date('M d, Y', strtotime($res['date'])); ?>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <?php echo date('g:i A', strtotime($res['time'])); ?>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <?php echo $res['guests']; ?> guests
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-16 border-t border-white/10 py-8">
        <div class="max-w-6xl mx-auto px-4 text-center text-gray-500">
            <p>&copy; <?php echo date('Y'); ?> Dine With Us. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
