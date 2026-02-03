<?php
$pageTitle = 'Nos Menus - Victory Restaurant';
require_once __DIR__ . '/components/header.php';

// Fetch menus with optimized query
$menus = Database::query("SELECT * FROM menus");
?>

    <!-- Hero Section -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-dark-950 via-dark-900 to-surface"></div>
            <img src="img/heading-bg.jpg" alt="" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-dark-950 via-dark-950/50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 rounded-full bg-brand-500/10 text-brand-400 text-sm font-medium mb-6">Notre Carte</span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white mb-6">
                Découvrez Nos <span class="gradient-text">Menus</span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                Une sélection raffinée de plats préparés avec passion, utilisant les meilleurs ingrédients frais et locaux.
            </p>
        </div>
    </section>

    <!-- Menu Sections -->
    <section class="py-20 relative">
        <div class="absolute inset-0 bg-gradient-to-b from-dark-950 to-surface"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php 
            $index = 0;
            foreach ($menus as $menu): 
                $menu_id = $menu['id_menu'];
                $plats = Database::query("SELECT * FROM plats WHERE id_menu = ?", [$menu_id]);
                $isReversed = $index % 2 === 1;
            ?>
            
            <div class="mb-24 last:mb-0">
                <div class="grid lg:grid-cols-2 gap-12 items-start <?php echo $isReversed ? 'lg:grid-flow-dense' : ''; ?>">
                    <!-- Menu Image -->
                    <div class="<?php echo $isReversed ? 'lg:col-start-2' : ''; ?> relative group">
                        <div class="absolute -inset-4 bg-gradient-to-r from-brand-500/20 to-brand-600/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative overflow-hidden rounded-2xl">
                            <img src="<?php echo Security::sanitize($menu['image_menu']); ?>" 
                                 alt="<?php echo Security::sanitize($menu['nom_menu']); ?>" 
                                 class="w-full h-80 lg:h-[450px] object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark-950/80 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 right-6">
                                <span class="inline-block px-3 py-1 rounded-full bg-brand-500/20 text-brand-400 text-sm font-medium mb-2">
                                    <?php echo count($plats); ?> plats
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Menu Content -->
                    <div class="<?php echo $isReversed ? 'lg:col-start-1 lg:row-start-1' : ''; ?>">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-1 bg-brand-500 rounded-full"></div>
                            <span class="text-brand-400 font-medium">Menu <?php echo $index + 1; ?></span>
                        </div>
                        
                        <h2 class="text-3xl lg:text-4xl font-display font-bold text-white mb-6">
                            <?php echo Security::sanitize($menu['nom_menu']); ?>
                        </h2>
                        
                        <p class="text-gray-400 mb-8">
                            <?php echo isset($menu['description']) ? Security::sanitize($menu['description']) : 'Une sélection de plats soigneusement préparés pour satisfaire vos papilles.'; ?>
                        </p>
                        
                        <!-- Dishes List -->
                        <div class="space-y-4">
                            <?php foreach ($plats as $plat): ?>
                            <div class="group/item glass rounded-xl p-4 hover:bg-white/10 transition-all duration-300 card-hover">
                                <div class="flex gap-4">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="<?php echo Security::sanitize($plat['image']); ?>" 
                                             alt="<?php echo Security::sanitize($plat['nom_plat']); ?>" 
                                             class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <h4 class="font-semibold text-white group-hover/item:text-brand-400 transition-colors">
                                                    <?php echo Security::sanitize($plat['nom_plat']); ?>
                                                </h4>
                                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                                    <?php echo isset($plat['description']) ? Security::sanitize($plat['description']) : 'Un délicieux plat préparé avec des ingrédients frais.'; ?>
                                                </p>
                                            </div>
                                            <span class="text-brand-400 font-bold text-lg whitespace-nowrap">
                                                <?php echo number_format($plat['prix'], 2); ?>€
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <?php if (empty($plats)): ?>
                            <div class="glass rounded-xl p-8 text-center">
                                <p class="text-gray-400">Aucun plat disponible dans ce menu pour le moment.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php 
                $index++;
            endforeach; 
            ?>
            
            <?php if (empty($menus)): ?>
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-brand-500/10 flex items-center justify-center">
                    <svg class="w-10 h-10 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Aucun menu disponible</h3>
                <p class="text-gray-400">Nos menus seront bientôt disponibles. Revenez nous voir!</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Reservation CTA Section -->
    <section id="reservation" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-surface"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-brand-500/50 to-transparent"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Image Side -->
                <div class="relative hidden lg:block">
                    <div class="absolute -inset-4 bg-gradient-to-r from-brand-500/20 to-brand-600/20 rounded-3xl blur-2xl"></div>
                    <img src="img/book_left_image.jpg" alt="Restaurant Interior" class="relative w-full h-[600px] object-cover rounded-3xl shadow-2xl border border-white/10">
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
                                    <?php for ($h = 10; $h <= 22; $h++): ?>
                                    <option value="<?php echo sprintf('%02d:00', $h); ?>" class="bg-dark-900"><?php echo sprintf('%02d:00', $h); ?></option>
                                    <?php endfor; ?>
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
                                    <?php foreach ($menus as $menu): ?>
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

<?php require_once __DIR__ . '/components/footer.php'; ?>