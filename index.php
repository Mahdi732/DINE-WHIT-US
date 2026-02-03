<?php
$pageTitle = 'Victory Restaurant - Cuisine Raffinée';
require_once __DIR__ . '/components/header.php';
?>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-dark-950 via-dark-900 to-surface"></div>
            <img src="img/banner-bg.jpg" alt="" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-transparent to-transparent"></div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-brand-600/10 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-500/10 border border-brand-500/20 mb-8 animate-fade-in">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                        <span class="text-brand-400 text-sm font-medium">Bienvenue chez Victory</span>
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-display font-bold text-white leading-tight mb-6 animate-slide-up">
                        Une Expérience
                        <span class="block gradient-text">Culinaire Unique</span>
                    </h1>
                    
                    <p class="text-lg text-gray-400 max-w-xl mx-auto lg:mx-0 mb-10 animate-slide-up" style="animation-delay: 0.2s;">
                        Découvrez une cuisine raffinée et authentique, préparée avec passion et créativité par nos chefs talentueux.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start animate-slide-up" style="animation-delay: 0.4s;">
                        <a href="menu.php" class="w-full sm:w-auto px-8 py-4 rounded-xl btn-primary text-white font-semibold text-center shadow-lg">
                            Découvrir le Menu
                        </a>
                        <a href="#reservation" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white/5 border border-white/10 text-white font-semibold hover:bg-white/10 transition-all text-center">
                            Réserver une Table
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex items-center gap-8 mt-12 justify-center lg:justify-start animate-slide-up" style="animation-delay: 0.6s;">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">15+</div>
                            <div class="text-sm text-gray-500">Années d'expérience</div>
                        </div>
                        <div class="w-px h-12 bg-white/10"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">50+</div>
                            <div class="text-sm text-gray-500">Plats signature</div>
                        </div>
                        <div class="w-px h-12 bg-white/10"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">4.9</div>
                            <div class="text-sm text-gray-500">Note moyenne</div>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image -->
                <div class="relative hidden lg:block">
                    <div class="relative z-10">
                        <div class="absolute -inset-4 bg-gradient-to-r from-brand-500/20 to-brand-600/20 rounded-3xl blur-2xl"></div>
                        <img src="img/cook_02.jpg" alt="Chef preparing food" class="relative w-full h-[500px] object-cover rounded-3xl shadow-2xl border border-white/10">
                    </div>
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl animate-float">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-brand-500 flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">Produits Frais</div>
                                <div class="text-gray-400 text-sm">Ingrédients locaux</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 rounded-full border-2 border-white/30 flex justify-center pt-2">
                <div class="w-1.5 h-3 rounded-full bg-brand-500"></div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950 to-surface"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 rounded-full bg-brand-500/10 text-brand-400 text-sm font-medium mb-4">Nos Spécialités</span>
                <h2 class="text-3xl sm:text-4xl font-display font-bold text-white mb-4">
                    Explorez Nos Catégories
                </h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Du petit-déjeuner au dîner, découvrez une variété de plats préparés avec soin pour chaque moment de votre journée.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Breakfast Card -->
                <div class="group card-hover">
                    <div class="relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative">
                            <div class="w-full h-48 rounded-xl overflow-hidden mb-6">
                                <img src="img/breakfast_menu.jpg" alt="Petit-déjeuner" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-semibold text-white group-hover:text-brand-400 transition-colors">Petit-déjeuner</h3>
                                <span class="text-brand-400 text-sm">7h - 11h</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-4">Commencez votre journée avec nos délicieux plats matinaux préparés avec des ingrédients frais.</p>
                            <a href="menu.php" class="inline-flex items-center gap-2 text-brand-400 font-medium text-sm group-hover:gap-3 transition-all">
                                Voir le menu
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Lunch Card -->
                <div class="group card-hover">
                    <div class="relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative">
                            <div class="w-full h-48 rounded-xl overflow-hidden mb-6">
                                <img src="img/cook_02.jpg" alt="Déjeuner" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-semibold text-white group-hover:text-brand-400 transition-colors">Déjeuner</h3>
                                <span class="text-brand-400 text-sm">11h30 - 15h</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-4">Des plats savoureux et équilibrés pour une pause déjeuner parfaite au milieu de votre journée.</p>
                            <a href="menu.php" class="inline-flex items-center gap-2 text-brand-400 font-medium text-sm group-hover:gap-3 transition-all">
                                Voir le menu
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Dinner Card -->
                <div class="group card-hover">
                    <div class="relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative">
                            <div class="w-full h-48 rounded-xl overflow-hidden mb-6">
                                <img src="img/dinner_menu.jpg" alt="Dîner" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-semibold text-white group-hover:text-brand-400 transition-colors">Dîner</h3>
                                <span class="text-brand-400 text-sm">18h - 23h</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-4">Une expérience gastronomique raffinée pour terminer votre journée en beauté.</p>
                            <a href="menu.php" class="inline-flex items-center gap-2 text-brand-400 font-medium text-sm group-hover:gap-3 transition-all">
                                Voir le menu
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reservation Section -->
    <section id="reservation" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-surface"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Image Side -->
                <div class="relative hidden lg:block">
                    <div class="absolute -inset-4 bg-gradient-to-r from-brand-500/20 to-brand-600/20 rounded-3xl blur-2xl"></div>
                    <img src="img/book_left_image.jpg" alt="Restaurant Interior" class="relative w-full h-[600px] object-cover rounded-3xl shadow-2xl border border-white/10">
                    
                    <!-- Floating Elements -->
                    <div class="absolute -right-6 top-1/4 glass p-4 rounded-xl shadow-xl animate-float">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white text-sm font-medium">Confirmation rapide</div>
                                <div class="text-gray-400 text-xs">En moins de 2h</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Side -->
                <div>
                    <span class="inline-block px-4 py-2 rounded-full bg-brand-500/10 text-brand-400 text-sm font-medium mb-4">Réservation</span>
                    <h2 class="text-3xl sm:text-4xl font-display font-bold text-white mb-4">
                        Réservez Votre Table
                    </h2>
                    <p class="text-gray-400 mb-8">
                        Réservez votre table en quelques clics et profitez d'une expérience culinaire inoubliable.
                    </p>
                    
                    <?php if (!Security::isLoggedIn()): ?>
                    <div class="glass p-6 rounded-2xl mb-6 border-l-4 border-brand-500">
                        <p class="text-gray-300 text-sm">
                            <span class="text-brand-400 font-semibold">Note:</span> 
                            Veuillez vous <a href="login.php" class="text-brand-400 underline hover:text-brand-300">connecter</a> pour effectuer une réservation.
                        </p>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="reservation.php" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
                        
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                                <input type="date" name="date_reservation" required min="<?php echo date('Y-m-d'); ?>"
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Heure</label>
                                <select name="heure_reservation" required
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-brand-500 transition-colors">
                                    <option value="" class="bg-dark-900">Sélectionnez une heure</option>
                                    <option value="10:00" class="bg-dark-900">10:00</option>
                                    <option value="11:00" class="bg-dark-900">11:00</option>
                                    <option value="12:00" class="bg-dark-900">12:00</option>
                                    <option value="13:00" class="bg-dark-900">13:00</option>
                                    <option value="14:00" class="bg-dark-900">14:00</option>
                                    <option value="18:00" class="bg-dark-900">18:00</option>
                                    <option value="19:00" class="bg-dark-900">19:00</option>
                                    <option value="20:00" class="bg-dark-900">20:00</option>
                                    <option value="21:00" class="bg-dark-900">21:00</option>
                                    <option value="22:00" class="bg-dark-900">22:00</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Nom complet</label>
                                <input type="text" name="nom" placeholder="Votre nom" required
                                    value="<?php echo $currentUser ? Security::sanitize($currentUser['nom'] . ' ' . $currentUser['prenom']) : ''; ?>"
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Téléphone</label>
                                <input type="tel" name="telephone" placeholder="+33 6 00 00 00 00" required
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors">
                            </div>
                        </div>
                        
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Nombre de personnes</label>
                                <select name="nombre_personnes" required
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-brand-500 transition-colors">
                                    <option value="" class="bg-dark-900">Sélectionnez</option>
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>" class="bg-dark-900"><?php echo $i; ?> personne<?php echo $i > 1 ? 's' : ''; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Menu</label>
                                <select name="id_menu" required
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-brand-500 transition-colors">
                                    <option value="" class="bg-dark-900">Choisir un menu</option>
                                    <?php
                                    $menus = Database::query("SELECT id_menu, nom_menu FROM menus");
                                    foreach ($menus as $menu):
                                    ?>
                                    <option value="<?php echo $menu['id_menu']; ?>" class="bg-dark-900">
                                        <?php echo Security::sanitize($menu['nom_menu']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full py-4 rounded-xl btn-primary text-white font-semibold shadow-lg <?php echo !Security::isLoggedIn() ? 'opacity-50 cursor-not-allowed' : ''; ?>"
                            <?php echo !Security::isLoggedIn() ? 'disabled' : ''; ?>>
                            Confirmer la Réservation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-600 to-brand-500"></div>
        <div class="absolute inset-0 bg-[url('img/banner-bg.jpg')] bg-cover bg-center opacity-10"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-display font-bold text-white mb-4">
                Restez Informé
            </h2>
            <p class="text-white/80 mb-8 max-w-2xl mx-auto">
                Inscrivez-vous à notre newsletter pour recevoir nos offres spéciales, événements et nouveautés culinaires.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input type="email" placeholder="Votre adresse email" required
                    class="flex-1 px-6 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/60 focus:bg-white/20 focus:border-white/40 transition-all">
                <button type="submit" class="px-8 py-4 rounded-xl bg-dark-900 text-white font-semibold hover:bg-dark-800 transition-all shadow-xl">
                    S'inscrire
                </button>
            </form>
            
            <p class="text-white/60 text-sm mt-4">
                En vous inscrivant, vous acceptez de recevoir nos communications. Désabonnement possible à tout moment.
            </p>
        </div>
    </section>

<?php require_once __DIR__ . '/components/footer.php'; ?>