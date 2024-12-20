<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Victory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f4f4] text-[#333333]">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-[#ff6b6b]">Victory</a>
            <nav>
                <ul class="flex space-x-6">
                <li><a href="index.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Accueil</a></li>
                <li><a href="menu.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Menus</a></li>
                <?php   
                    require 'db.php';
                    session_start();
                    if(!isset($_SESSION['user_id'])){
                        echo '<li><a href="login.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Login</a></li>';
                    }else{
                        if($conn){
                            $getID = $_SESSION['user_id'];
                            $getUsers = $conn->prepare("SELECT * FROM client WHERE id_client = ?");
                            $getUsers->bind_param("i",$getID);
                            if($getUsers->execute()){
                                $getResult = $getUsers->get_result();
                                $line = $getResult->fetch_assoc();
                                if($line['email'] == "admin@gmail.com"){
                                    echo '<li><a href="admin.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Admin</a></li>';
                                }else{
                                    echo '<li><a href="user.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Profile</a></li>';
                                }
                            }
                            
                        }
                    }


                ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class=" bg-[url('img/banner-bg.jpg')] bg-cover bg-center h-[600px] flex items-center">
        <div class="container mx-auto text-center text-white">
            <h4 class="text-xl mb-4">Découvrez des menus délicieux</h4>
            <h2 class="text-5xl font-bold mb-6">Restaurant Asiatique</h2>
            <p class="mb-8 max-w-2xl mx-auto">
                Découvrez une cuisine raffinée et authentique, préparée avec passion et créativité.
            </p>
            <a href="#" class="bg-[#ff6b6b] text-white px-8 py-4 rounded-full hover:bg-opacity-80 transition-all">
                Commander Maintenant
            </a>
        </div>
    </section>

    <section class="container mx-auto py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center hover:scale-105 transition-transform">
                <img src="img/breakfast_menu.jpg" alt="Petit-déjeuner" class="mx-auto w-[14rem] h-[14rem] mb-4 rounded-lg">
                <h4 class="text-xl font-semibold">Petit-déjeuner</h4>
            </div>
            <div class="text-center hover:scale-105 transition-transform">
                <img src="img/cook_02.jpg" alt="Déjeuner" class="mx-auto w-[14rem] h-[14rem] mb-4 rounded-lg">
                <h4 class="text-xl font-semibold">Déjeuner</h4>
            </div>
            <div class="text-center hover:scale-105 transition-transform">
                <img src="img/dinner_menu.jpg" alt="Dîner" class="mx-auto w-[14rem] h-[14rem] mb-4 rounded-lg">
                <h4 class="text-xl font-semibold">Dîner</h4>
            </div>
        </div>
    </section>

    <section class="bg-white md:w-auto h-[30rem] md:h-[40rem] md:py-16 flex flex-col md:flex-row md:justify-center items-center">
    <div class="bg-[url('img/book_left_image.jpg')] bg-cover bg-center h-[14rem] md:h-[26.7rem] w- md:w-[30rem] md:rounded-l-lg">
    </div>

    <div class="container w-auto items-center bg-[#e5e7eb] flex flex-col md:w-[30rem] p-8 shadow-md">
        <h2 class="text-4xl font-bold text-center mb-12">Réservez Votre Table</h2>
        <div class="w-auto md:max-w-4xl md:mx-auto">
            <form class="grid grid-cols-2 md:grid md:grid-cols-2 gap-6">
                <select class="border p-3 rounded-lg">
                    <option value="" disabled selected hidden>Sélectionnez un jour</option>
                    <option>Lundi</option>
                    <option>Mardi</option>
                    <option>Mercredi</option>
                    <option>Jeudi</option>
                    <option>Vendredi</option>
                    <option>Samedi</option>
                    <option>Dimanche</option>
                </select>
                <select class="border p-3 rounded-lg">
                    <option value="" disabled selected hidden>Sélectionnez une heure</option>
                    <option>10:00</option>
                    <option>12:00</option>
                    <option>14:00</option>
                    <option>16:00</option>
                    <option>18:00</option>
                    <option>20:00</option>
                    <option>22:00</option>
                </select>
                <input type="text" placeholder="Nom complet" class="border p-3 rounded-lg">
                <input type="tel" placeholder="Numéro de téléphone" class="border p-3 rounded-lg">
                <select class="border p-3 rounded-lg ">
                    <option value="" disabled selected hidden>Nombre de personnes</option>
                    <option>1 personne</option>
                    <option>2 personnes</option>
                    <option>3 personnes</option>
                    <option>4 personnes</option>
                    <option>5 personnes</option>
                    <option>6 personnes</option>
                </select>
                <select class="border p-3 rounded-lg ">
                    <option value="" disabled selected hidden>Menu</option>
                    <option>1 personne</option>
                    <option>2 personnes</option>
                    <option>3 personnes</option>
                    <option>4 personnes</option>
                </select>
                <button type="submit" class="bg-[#ff6b6b] text-white p-4 rounded-lg col-span-2 hover:bg-opacity-80">
                    Réserver une table
                </button>
            </form>
        </div>
    </div>
    </section>

    <section class="bg-[#ff6b6b] text-white pt-4 h-[10rem]">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl md:text-4xl font-bold mb-8">Abonnez-vous à notre Newsletter</h2>
            <form class="max-w-xl mx-[1rem] md:mx-auto flex">
                <input 
                    type="email" 
                    placeholder="Votre adresse email" 
                    class="flex-grow p-4 text-[#333333] rounded-l-lg"
                >
                <button type="submit" class="bg-[#333333] text-white px-8 py-4 rounded-r-lg hover:bg-opacity-80">
                    S'inscrire
                </button>
            </form>
        </div>
    </section>

    <footer class="bg-[#333333] text-white py-8">
        <div class="container mx-auto flex justify-between items-center">
            <p>&copy; 2024 Restaurant Victory</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-[#ff6b6b]">Facebook</a>
                <a href="#" class="hover:text-[#ff6b6b]">Twitter</a>
                <a href="#" class="hover:text-[#ff6b6b]">LinkedIn</a>
            </div>
        </div>
    </footer>
</body>
</html>