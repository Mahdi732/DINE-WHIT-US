<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Moderne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#54162B',
                        'secondary': '#B4182D',
                        'accent': '#fda481',
                        'dark-blue': '#37415c',
                        'deep-blue': '#242e49',
                        'night-blue': '#181a2f'
                    },
                    animation: {
                        'fade-in-down': 'fade-in-down 0.7s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        'fade-in-down': {
                            '0%': { 
                                opacity: '0',
                                transform: 'translateY(-20px)'
                            },
                            '100%': { 
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }
        .image-placeholder {
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fda481;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-deep-blue to-night-blue text-white min-h-screen flex flex-col">
    <!-- Header -->
    <header class="fixed w-full top-0 z-50 glass-morphism shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-fade-in-down">
                <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                    <span class="text-white font-bold">M</span>
                </div>
                <span class="text-2xl font-bold text-accent tracking-wider">ModernDesign</span>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#" class="text-accent hover:text-white transition-all duration-300 transform hover:scale-110 relative group">
                        Accueil
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a></li>
                    <li><a href="#" class="text-accent hover:text-white transition-all duration-300 transform hover:scale-110 relative group">
                        Services
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a></li>
                    <li><a href="#" class="text-accent hover:text-white transition-all duration-300 transform hover:scale-110 relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent group-hover:w-full transition-all duration-300"></span>
                    </a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 pt-24 pb-12 flex-grow">
        <div class="grid md:grid-cols-2 gap-8">
            <div class="glass-morphism p-8 rounded-2xl shadow-2xl transform transition-all duration-500 hover:scale-105 animate-fade-in-down">
                <h1 class="text-4xl font-bold mb-6 text-accent">Bienvenue</h1>
                <p class="text-lg leading-relaxed mb-6">
                    Découvrez une expérience numérique révolutionnaire. 
                    Nos solutions innovantes transforment votre présence digitale.
                </p>
                <div class="flex space-x-4 mb-6">
                    <button class="bg-secondary text-white px-6 py-3 rounded-full hover:bg-accent transition-all duration-300 transform hover:scale-105">
                        Découvrir
                    </button>
                    <button class="border border-accent text-accent px-6 py-3 rounded-full hover:bg-accent hover:text-primary transition-all duration-300 transform hover:scale-105">
                        En Savoir Plus
                    </button>
                </div>
                <!-- Espace pour image principale -->
                <div class="w-full h-64 image-placeholder rounded-2xl">
                    Image Principale
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">01</div>
                    <h3 class="text-xl mb-3">Design Créatif</h3>
                    <p class="text-sm opacity-75">Solutions visuelles innovantes</p>
                    <!-- Espace pour mini image -->
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 1
                    </div>
                </div>
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">02</div>
                    <h3 class="text-xl mb-3">Tech Avancée</h3>
                    <p class="text-sm opacity-75">Technologies de pointe</p>
                    <!-- Espace pour mini image -->
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 2
                    </div>
                </div>
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">03</div>
                    <h3 class="text-xl mb-3">Support Total</h3>
                    <p class="text-sm opacity-75">Accompagnement personnalisé</p>
                    <!-- Espace pour mini image -->
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 3
                    </div>
                </div>
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">04</div>
                    <h3 class="text-xl mb-3">Stratégie</h3>
                    <p class="text-sm opacity-75">Approche sur mesure</p>
                    <!-- Espace pour mini image -->
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 4
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouvelle section avec galerie d'images -->
        <section class="mt-12">
            <h2 class="text-3xl font-bold text-accent text-center mb-8">Notre Portfolio</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="w-full h-64 image-placeholder rounded-2xl">
                    Projet 1
                </div>
                <div class="w-full h-64 image-placeholder rounded-2xl">
                    Projet 2
                </div>
                <div class="w-full h-64 image-placeholder rounded-2xl">
                    Projet 3
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-primary bg-opacity-50 py-8 mt-auto">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <p class="text-sm text-accent">© 2024 ModernDesign. Tous droits réservés.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-accent hover:text-white transition-colors duration-300 transform hover:scale-125">LinkedIn</a>
                <a href="#" class="text-accent hover:text-white transition-colors duration-300 transform hover:scale-125">Twitter</a>
                <a href="#" class="text-accent hover:text-white transition-colors duration-300 transform hover:scale-125">GitHub</a>
            </div>
        </div>
    </footer>
</body>
</html>