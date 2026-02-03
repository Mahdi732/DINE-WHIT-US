<?php
/**
 * Reusable Header Component
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

$currentUser = User::getCurrentUser();
$isLoggedIn = Security::isLoggedIn();
$isAdmin = Security::isAdmin();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Victory Restaurant - Découvrez une cuisine raffinée et authentique">
    <meta name="theme-color" content="#1a1a2e">
    <title><?php echo $pageTitle ?? 'Victory Restaurant'; ?></title>
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': {
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
                        },
                        'dark': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        },
                        'accent': '#e11d48',
                        'surface': '#16213e',
                        'surface-light': '#1a1a2e',
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'body': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.4s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    },
                    boxShadow: {
                        'glow': '0 0 20px rgba(249, 115, 22, 0.3)',
                        'glow-lg': '0 0 40px rgba(249, 115, 22, 0.4)',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a2e;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #f97316, #ea580c);
            border-radius: 4px;
        }
        
        /* Glass morphism */
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #f97316, #fb923c, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Smooth transitions */
        * {
            scroll-behavior: smooth;
        }
        
        /* Focus styles */
        input:focus, select:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }
        
        /* Button hover effect */
        .btn-primary {
            background: linear-gradient(135deg, #f97316, #ea580c);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4);
        }
        
        /* Card hover effect */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-hover:hover {
            transform: translateY(-8px);
        }
        
        /* Loading animation */
        .loader {
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-top-color: #f97316;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-dark-950 text-gray-100 font-body antialiased">
    <!-- Flash Messages -->
    <?php if ($flashMessage = Security::getFlashMessage()): ?>
    <div id="flash-message" class="fixed top-4 right-4 z-50 animate-slide-down">
        <div class="px-6 py-4 rounded-xl shadow-2xl <?php echo $flashMessage['type'] === 'error' ? 'bg-red-500' : ($flashMessage['type'] === 'success' ? 'bg-green-500' : 'bg-brand-500'); ?> text-white flex items-center gap-3">
            <span><?php echo Security::sanitize($flashMessage['text']); ?></span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 hover:opacity-70 transition-opacity">&times;</button>
        </div>
    </div>
    <script>setTimeout(() => document.getElementById('flash-message')?.remove(), 5000);</script>
    <?php endif; ?>

    <!-- Navigation -->
    <header class="fixed top-0 left-0 right-0 z-40 transition-all duration-300" id="main-header">
        <nav class="glass-dark border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo -->
                    <a href="index.php" class="flex items-center gap-3 group">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center shadow-glow group-hover:shadow-glow-lg transition-all duration-300">
                            <span class="text-white font-display font-bold text-xl">V</span>
                        </div>
                        <span class="text-2xl font-display font-bold text-white group-hover:text-brand-400 transition-colors">Victory</span>
                    </a>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center gap-1">
                        <a href="index.php" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 <?php echo $currentPage === 'index.php' ? 'bg-brand-500/20 text-brand-400' : 'text-gray-300 hover:text-white hover:bg-white/5'; ?>">
                            Accueil
                        </a>
                        <a href="menu.php" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 <?php echo $currentPage === 'menu.php' ? 'bg-brand-500/20 text-brand-400' : 'text-gray-300 hover:text-white hover:bg-white/5'; ?>">
                            Menus
                        </a>
                        
                        <?php if ($isLoggedIn): ?>
                            <?php if ($isAdmin): ?>
                                <a href="admin.php" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 <?php echo $currentPage === 'admin.php' ? 'bg-brand-500/20 text-brand-400' : 'text-gray-300 hover:text-white hover:bg-white/5'; ?>">
                                    Dashboard
                                </a>
                            <?php else: ?>
                                <a href="user.php" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 <?php echo $currentPage === 'user.php' ? 'bg-brand-500/20 text-brand-400' : 'text-gray-300 hover:text-white hover:bg-white/5'; ?>">
                                    Mon Profil
                                </a>
                            <?php endif; ?>
                            
                            <!-- User Menu -->
                            <div class="flex items-center gap-4 ml-4 pl-4 border-l border-white/10">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center text-sm font-semibold text-white">
                                        <?php echo strtoupper(substr($currentUser['prenom'] ?? 'U', 0, 1)); ?>
                                    </div>
                                    <span class="text-sm font-medium text-gray-300 hidden lg:block">
                                        <?php echo Security::sanitize($currentUser['prenom'] ?? 'User'); ?>
                                    </span>
                                </div>
                                <form action="logout.php" method="post" class="inline">
                                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all duration-300">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <a href="login.php" class="ml-4 px-6 py-2.5 rounded-xl text-sm font-semibold btn-primary text-white shadow-lg">
                                Connexion
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="md:hidden hidden border-t border-white/5">
                <div class="px-4 py-6 space-y-3">
                    <a href="index.php" class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all <?php echo $currentPage === 'index.php' ? 'bg-brand-500/20 text-brand-400' : ''; ?>">Accueil</a>
                    <a href="menu.php" class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all <?php echo $currentPage === 'menu.php' ? 'bg-brand-500/20 text-brand-400' : ''; ?>">Menus</a>
                    
                    <?php if ($isLoggedIn): ?>
                        <?php if ($isAdmin): ?>
                            <a href="admin.php" class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all">Dashboard</a>
                        <?php else: ?>
                            <a href="user.php" class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all">Mon Profil</a>
                        <?php endif; ?>
                        <form action="logout.php" method="post">
                            <button type="submit" class="w-full text-left px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-all">Déconnexion</button>
                        </form>
                    <?php else: ?>
                        <a href="login.php" class="block px-4 py-3 rounded-lg text-center btn-primary text-white font-semibold">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Main Content Wrapper -->
    <main class="pt-20">
