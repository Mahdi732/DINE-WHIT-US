<?php
session_start();
include("/xampp/htdocs/dinewhitus/db.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: admin.php");
    exit;
}
$user_email = $_SESSION['user_email'];
$sql = "SELECT * FROM client WHERE email = ?";
$stmt = mysqli_prepare($conn ,$sql);
mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0 ) {
    $user = mysqli_fetch_assoc($result);
}else {
    echo "User not found";
    exit;
}

$sql = "SELECT COUNT(*) AS total FROM menus";
$result = mysqli_query($conn, $sql);
$count = 0;
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['total'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) AS total FROM plats";
$result = mysqli_query($conn, $sql);
$count_plat = 0;
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count_plat = $row['total'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) AS total FROM client";
$result = mysqli_query($conn, $sql);
$count_client = 0;
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count_client = $row['total'];
} else {
    echo "Error: " . mysqli_error($conn);
}

$sql = "SELECT COUNT(*) AS total FROM reservations";
$result = mysqli_query($conn, $sql);
$count_reservation = 0;
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count_reservation = $row['total'];
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
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
    <div class="w-64 glass-morphism min-h-screen fixed left-0 top-0">
        <div class="p-4">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                    <img class="rounded-full w-full h-full object-cover" src="img/wissam.jpg" alt="Admin">
                </div>
                <span class="text-xl font-bold text-accent"><?php echo $user['nom'] . " " . $user['prenom'] ?></span>
            </div>
            
            <nav class="space-y-4">
                <a href="index.php" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Home
                </a>
                <a href="menu.php" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Menu
                </a>
                <a href="dishes.php" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    dishes
                </a>
            </nav>
        </div>
    </div>

    <main class="ml-64 flex-grow p-8">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-accent">Tableau de Bord</h1>
                <div class="flex gap-3">
                <button class="bg-secondary text-white px-6 py-2 rounded-lg hover:bg-accent transition-all" onclick="document.getElementById('addplatform').classList.toggle('hidden')">
                    Nouveau Plat
                </button>
                <button class="bg-secondary text-white px-6 py-2 rounded-lg hover:bg-accent transition-all" onclick="document.getElementById('addmenuform').classList.toggle('hidden')">
                    Nouveau menu
                </button>
                <form action="logout.php" method="post">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-md text-sm transition duration-300">
                        Logout
                    </button>
                </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Total Menus</h3>
                    <p class="text-3xl font-bold text-accent"><?php echo $count; ?></p>
                </div>
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Total Plat</h3>
                    <p class="text-3xl font-bold text-accent"><?php echo $count_plat; ?></p>
                </div>
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Utilisateurs</h3>
                    <p class="text-3xl font-bold text-accent"><?php echo $count_client; ?></p>
                </div>
                <div class="glass-morphism p-6 rounded-xl">
                    <h3 class="text-lg mb-2">Reservation</h3>
                    <p class="text-3xl font-bold text-accent"><?php echo $count_reservation; ?></p>
                </div>
            </div>

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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6 mt-8">
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">01</div>
                    <h3 class="text-xl mb-3">Design Créatif</h3>
                    <p class="text-sm opacity-75">Solutions visuelles innovantes</p>
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 1
                    </div>
                </div>
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">02</div>
                    <h3 class="text-xl mb-3">Tech Avancée</h3>
                    <p class="text-sm opacity-75">Technologies de pointe</p>
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 2
                    </div>
                </div>
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">03</div>
                    <h3 class="text-xl mb-3">Support Total</h3>
                    <p class="text-sm opacity-75">Accompagnement personnalisé</p>
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="glass-morphism p-6 rounded-2xl text-center transform transition-all duration-500 hover:scale-105 animate-pulse-slow">
                    <div class="text-4xl font-bold text-accent mb-4">04</div>
                    <h3 class="text-xl mb-3">Stratégie</h3>
                    <p class="text-sm opacity-75">Approche sur mesure</p>
                    <div class="w-full h-32 image-placeholder mt-4 rounded-xl">
                        Image Service 4
                    </div>
                </div>
            </div>
    </main>

    <div class="bg-black absolute justify-center w-full hidden" id="addmenuform">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="glass-morphism p-8 rounded-2xl max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-accent">Ajouter un menu</h2>
                <button onclick="document.getElementById('addmenuform').classList.add('hidden')" 
                        class="text-accent hover:text-white">
                    ✕
                </button>
            </div>
            
            <form method="POST" action="addmenu.php" enctype="multipart/form-data" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-accent text-sm font-bold">Image du Menu</label>
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
                    <label for="dishName" class="block text-accent text-sm font-bold">Nom du Menu</label>
                    <input type="text" id="dishName" name="name" required
                        class="w-full px-4 py-2 bg-deep-blue border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary text-white"
                        placeholder="Entrez le nom du menu">
                </div>
                <div class="space-y-2">
                    <label class="block text-accent text-sm font-bold">Description</label>
                    <textarea name="description" rows="3" required
                        class="w-full px-4 py-2 bg-deep-blue border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary text-white"
                        placeholder="Entrez une description"></textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-accent text-sm font-bold">Choisir des Plats</label>
                    <div class="grid grid-cols-4 gap-4">
                        <?php
                        include("db.php");
                        $sql = "SELECT nom_plat, id_plat FROM plats";
                        $result = mysqli_query($conn, $sql);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                echo '<label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="plats[]" value="'. $fetch["id_plat"] .'"
                                    class="form-checkbox text-secondary">
                                    <span class="text-white">'. $fetch["nom_plat"] .'</span>
                                </label>';
                            }
                        }
                        ?>
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




    <div class="bg-black absolute justify-center w-full hidden" id="addplatform">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center ">
    <div class="glass-morphism p-8 rounded-2xl max-w-md w-full mx-4">
    <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-accent">Ajouter un plat</h2>
            <button onclick="document.getElementById('addplatform').classList.add('hidden')" 
                    class="text-accent hover:text-white">
                ✕
            </button>
        </div>
    <form method="POST" action="addplat.php" enctype="multipart/form-data" class="space-y-6">
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
                <label for="price" class="block text-accent text-sm font-bold">Prix ($)</label>
                <input type="number" id="price" name="price" step="0.01" required
                    class="w-full px-4 py-2 bg-deep-blue border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary text-white"
                    placeholder="0.00">
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