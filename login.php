<?php
$pageTitle = 'Connexion - Victory Restaurant';
require_once __DIR__ . '/components/header.php';
?>

    <section class="min-h-[calc(100vh-5rem)] flex items-center justify-center py-16 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-dark-950 via-dark-900 to-surface"></div>
            <img src="img/bomok-bg.jpg" alt="" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-1/4 -left-20 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-brand-600/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 w-full max-w-md mx-4">
            <div class="glass rounded-3xl shadow-2xl overflow-hidden">
                <!-- Tab Buttons -->
                <div class="flex">
                    <button id="loginTab" onclick="showLogin()" class="flex-1 py-5 text-center font-semibold text-white bg-white/10 border-b-2 border-brand-500 transition-all">
                        Connexion
                    </button>
                    <button id="signupTab" onclick="showSignup()" class="flex-1 py-5 text-center font-semibold text-gray-400 hover:text-white border-b-2 border-transparent transition-all">
                        Inscription
                    </button>
                </div>

                <!-- Login Form -->
                <div id="loginForm" class="p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-display font-bold text-white mb-2">Bon Retour!</h2>
                        <p class="text-gray-400 text-sm">Connectez-vous pour accéder à votre compte</p>
                    </div>
                    
                    <form method="POST" action="loginback.php" class="space-y-5">
                        <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
                        
                        <div>
                            <label for="loginEmail" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <input type="email" name="email_login" id="loginEmail" required
                                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="votre@email.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="loginPassword" class="block text-sm font-medium text-gray-300 mb-2">Mot de passe</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input type="password" name="password_login" id="loginPassword" required
                                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="••••••••">
                                <button type="button" onclick="togglePassword('loginPassword', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300">
                                    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 text-brand-500 focus:ring-brand-500">
                                <span class="ml-2 text-sm text-gray-400">Se souvenir de moi</span>
                            </label>
                            <a href="#" class="text-sm text-brand-400 hover:text-brand-300 transition-colors">Mot de passe oublié?</a>
                        </div>
                        
                        <button type="submit" class="w-full py-4 rounded-xl btn-primary text-white font-semibold shadow-lg">
                            Se Connecter
                        </button>
                    </form>
                    
                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/10"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-transparent text-gray-500">Ou continuer avec</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 mt-6">
                            <button type="button" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all">
                                <svg class="w-5 h-5" viewBox="0 0 24 24"><path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                                Google
                            </button>
                            <button type="button" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                Facebook
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sign Up Form -->
                <div id="signupForm" class="p-8 hidden">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-display font-bold text-white mb-2">Créer un Compte</h2>
                        <p class="text-gray-400 text-sm">Rejoignez-nous pour une expérience unique</p>
                    </div>
                    
                    <form method="POST" id="registerForm" class="space-y-5">
                        <input type="hidden" name="csrf_token" value="<?php echo Security::generateCSRFToken(); ?>">
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="signupName" class="block text-sm font-medium text-gray-300 mb-2">Nom</label>
                                <input name="name" type="text" id="signupName" required
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="Votre nom">
                            </div>
                            <div>
                                <label for="signupPrenom" class="block text-sm font-medium text-gray-300 mb-2">Prénom</label>
                                <input name="prenom" type="text" id="signupPrenom" required
                                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="Votre prénom">
                            </div>
                        </div>
                        
                        <div>
                            <label for="signupEmail" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <input name="email" type="email" id="signupEmail" required
                                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="votre@email.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="signupPassword" class="block text-sm font-medium text-gray-300 mb-2">Mot de passe</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input type="password" id="signupPassword" required minlength="6"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="Minimum 6 caractères">
                            </div>
                            <!-- Password strength indicator -->
                            <div class="mt-2 flex gap-1">
                                <div class="h-1 flex-1 rounded-full bg-white/10 password-strength-bar"></div>
                                <div class="h-1 flex-1 rounded-full bg-white/10 password-strength-bar"></div>
                                <div class="h-1 flex-1 rounded-full bg-white/10 password-strength-bar"></div>
                                <div class="h-1 flex-1 rounded-full bg-white/10 password-strength-bar"></div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="confirmPassword" class="block text-sm font-medium text-gray-300 mb-2">Confirmer le mot de passe</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </span>
                                <input name="password" type="password" id="confirmPassword" required
                                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-brand-500 transition-colors"
                                    placeholder="Confirmez votre mot de passe">
                            </div>
                            <p id="passwordMatch" class="mt-1 text-xs hidden"></p>
                        </div>
                        
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" id="check" required class="mt-1 w-4 h-4 rounded border-white/20 bg-white/5 text-brand-500 focus:ring-brand-500">
                            <span class="text-sm text-gray-400">
                                J'accepte les <a href="#" class="text-brand-400 hover:underline">Conditions d'utilisation</a> et la <a href="#" class="text-brand-400 hover:underline">Politique de confidentialité</a>
                            </span>
                        </label>
                        
                        <button type="submit" id="try" class="w-full py-4 rounded-xl bg-dark-800 hover:bg-dark-700 text-white font-semibold transition-all shadow-lg">
                            Créer mon compte
                        </button>
                    </form>
                    
                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/10"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-transparent text-gray-500">Ou s'inscrire avec</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 mt-6">
                            <button type="button" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all">
                                <svg class="w-5 h-5" viewBox="0 0 24 24"><path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                                Google
                            </button>
                            <button type="button" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                Facebook
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
// Handle registration
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name'])) {
    require_once __DIR__ . '/config/database.php';
    
    $name = Security::sanitize($_POST['name']);
    $prenom = Security::sanitize($_POST['prenom']);
    $email = Security::sanitize($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if email already exists
    $existing = Database::queryOne("SELECT id_client FROM client WHERE email = ?", [$email]);
    
    if ($existing) {
        Security::redirect('login.php', 'Cet email est déjà utilisé.', 'error');
    } else {
        try {
            Database::execute(
                "INSERT INTO client (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)",
                [$name, $prenom, $email, $password]
            );
            Security::redirect('login.php', 'Compte créé avec succès! Vous pouvez maintenant vous connecter.', 'success');
        } catch (Exception $e) {
            Security::redirect('login.php', 'Erreur lors de la création du compte.', 'error');
        }
    }
}
?>

<script src="js/main.js"></script>
<?php require_once __DIR__ . '/components/footer.php'; ?>