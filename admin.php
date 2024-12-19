<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Chef Wissam</title>
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
    </style>
</head>
<body class="bg-gradient-to-br from-deep-blue to-night-blue text-white min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 glass-morphism min-h-screen fixed left-0 top-0">
        <div class="p-4">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                    <img class="rounded-full w-full h-full object-cover" src="img/wissam.jpg" alt="Admin">
                </div>
                <span class="text-xl font-bold text-accent">Admin Panel</span>
            </div>
            
            <nav class="space-y-4">
                <a href="#" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Dashboard
                </a>
                <a href="#" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Gérer les Menus
                </a>
                <a href="#" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Utilisateurs
                </a>
                <a href="#" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Commandes
                </a>
                <a href="#" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Paramètres
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-grow p-8">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-accent">Tableau de Bord</h1>
                <button class="bg-secondary text-white px-6 py-2 rounded-lg hover:bg-accent transition-all" onclick="document.getElementById('addmenuform').classList.toggle('hidden')">
                    Nouveau Menu
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Total Menus</h3>
                    <p class="text-3xl font-bold text-accent">24</p>
                </div>
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Utilisateurs</h3>
                    <p class="text-3xl font-bold text-accent">156</p>
                </div>
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Commandes</h3>
                    <p class="text-3xl font-bold text-accent">38</p>
                </div>
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Revenus</h3>
                    <p class="text-3xl font-bold text-accent">4,250€</p>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="glass-morphism rounded-xl p-6">
                <h2 class="text-2xl font-bold mb-4 text-accent">Commandes Récentes</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="pb-4 text-accent">ID</th>
                                <th class="pb-4 text-accent">Client</th>
                                <th class="pb-4 text-accent">Menu</th>
                                <th class="pb-4 text-accent">Prix</th>
                                <th class="pb-4 text-accent">Status</th>
                                <th class="pb-4 text-accent">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-gray-700">
                                <td class="py-4">#1234</td>
                                <td class="py-4">Jean Dupont</td>
                                <td class="py-4">Menu Spécial</td>
                                <td class="py-4">75€</td>
                                <td class="py-4"><span class="px-2 py-1 bg-green-500 rounded-full text-sm">Complété</span></td>
                                <td class="py-4">
                                    <button class="text-accent hover:text-secondary">Voir détails</button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="bg-black absolute justify-center w-full hidden" id="addmenuform">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center ">
    <div class="glass-morphism p-8 rounded-2xl max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-accent">Ajouter un Menu</h2>
            <button onclick="document.getElementById('addmenuform').classList.add('hidden')" 
                    class="text-accent hover:text-white">
                ✕
            </button>
        </div>
        
        <form method="POST" action="addmenu.php" enctype="multipart/form-data" class="space-y-6">
            <div class="space-y-2">
                <label class="block text-accent text-sm font-bold">Image du Plat</label>
                <div class="flex items-center justify-center w-full">
                    <label class="w-full h-32 border-2 border-dashed border-accent rounded-lg flex flex-col items-center justify-center cursor-pointer hover:bg-deep-blue transition-colors">
                        <svg class="w-8 h-8 text-accent mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span class="text-sm text-accent">Choisir une image</span>
                        <input type="file" name="image" accept="image/*" class="hidden">
                    </label>
                </div>
            </div>
            <div class="space-y-2">
                <label for="dishName" class="block text-accent text-sm font-bold">Nom du Plat</label>
                <input type="text" id="dishName" name="name" required
                    class="w-full px-4 py-2 bg-deep-blue border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary text-white"
                    placeholder="Entrez le nom du plat">
            </div>
            <div class="space-y-2">
                <label for="price" class="block text-accent text-sm font-bold">Prix (€)</label>
                <input type="number" id="price" name="price" step="0.01" required
                    class="w-full px-4 py-2 bg-deep-blue border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary text-white"
                    placeholder="0.00">
            </div>
            <div class="space-y-2">
                <label class="block text-accent text-sm font-bold">Type de Plat</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="type" value="entree" required
                            class="form-checkbox text-secondary">
                        <span class="text-white">Entrée</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="type" value="plat" required
                            class="form-checkbox text-secondary">
                        <span class="text-white">Plat Principal</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="type" value="dessert" required
                            class="form-checkbox text-secondary">
                        <span class="text-white">Dessert</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="type" value="boisson" required
                            class="form-checkbox text-secondary">
                        <span class="text-white">Boisson</span>
                    </label>
                </div>
            </div>
            <button type="submit" 
                class="w-full bg-secondary text-white py-3 rounded-lg hover:bg-accent transition-colors duration-300 font-bold">
                Ajouter au Menu
            </button>
        </form>
    </div>
</div>
    </div>
</body>
</html>