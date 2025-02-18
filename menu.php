<?php
session_start();
include("/xampp/htdocs/DINE-WHIT-US/db.php");
$menus_query = "SELECT * FROM menus";
$menus_result = mysqli_query($conn, $menus_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Victory - Our Menus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-[#ff6b6b]">Victory</a>
            <nav>
            <ul class="flex space-x-6">
                <li><a href="index.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Accueil</a></li>
                <li><a href="menu.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Menus</a></li>
                <?php   

                    require 'db.php';

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
                                if(isset($line['email']) && $line['email'] == "admin@gmail.com"){
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

    <section class="bg-cover bg-center h-96 flex items-center justify-center" 
             style="background-image: url('img/heading-bg.jpg')">
        <div class="text-center">
            <h1 class="text-6xl text-white font-serif mb-4">Our Menus</h1>
            <p class="text-xl text-gray-200 max-w-xl mx-auto">
                Curabitur at dolor sed felis lacinia ultricies sit amet vel sem. 
                Vestibulum diam leo, sodales tempor lectus sed, varius gravida mi.
            </p>
        </div>
    </section>
 
    <div class="container mx-auto px-4 py-12 space-y-12">
    <?php
    while ($menu = mysqli_fetch_assoc($menus_result)) {
        $menu_id = $menu['id_menu'];
        $menu_name = $menu['nom_menu'];
        $menu_image = $menu['image_menu'];
        $plats_query = "SELECT * FROM plats WHERE id_menu = $menu_id";
        $plats_result = mysqli_query($conn, $plats_query);
        ?>
        <section class="grid md:grid-cols-2 gap-8 items-start">
            <div class="order-2 md:order-1">
                <img src="<?php echo $menu_image ?>" alt="Breakfast" class="w-full rounded-lg shadow-md">
            </div>
            <div class="order-1 md:order-2">
                <h2 class="text-3xl font-bold mb-6"><?php echo $menu_name ?></h2>
                <div class="space-y-4 ">
                <?php
                    while ($plat = mysqli_fetch_assoc($plats_result)) {
                        ?>
                    <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
                        <img src="<?php echo $plat["image"] ?>" alt="Breakfast Item" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h4 class="font-bold text-xl"><?php echo $plat["nom_plat"] ?></h4>
                            <p class="text-gray-600">Dreamcatcher squid ennui cliche chicharros nes echo small batch jean ditcher meal...</p>
                            <span class="text-[#ff6b6b] font-bold"><?php echo "$" . $plat["prix"] ?></span>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>

    </div>

    <section class="bg-white md:w-auto h-[30rem] md:h-[40rem] md:py-16 flex flex-col md:flex-row md:justify-center items-center">
    <div class="bg-[url('img/book_left_image.jpg')] bg-cover bg-center h-[14rem] md:h-[26.7rem] w- md:w-[30rem] md:rounded-l-lg">
    </div>

    <?php
$query = "SELECT id_menu, nom_menu FROM menus";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Erreur lors de la récupération des menus : " . mysqli_error($conn));
}
?>

<div class="container w-auto items-center bg-[#e5e7eb] flex flex-col md:w-[30rem] p-8 shadow-md">
    <h2 class="text-4xl font-bold text-center mb-12">Réservez Votre Table</h2>
    <div class="w-auto md:max-w-4xl md:mx-auto">
        <form method="POST" action="reservation.php" class="grid grid-cols-2 md:grid md:grid-cols-2 gap-6">
            <input class="border p-3 rounded-lg" type="date" name="date_reservation" required>
            <select class="border p-3 rounded-lg" name="heure_reservation" required>
                <option value="" disabled selected hidden>Sélectionnez une heure</option>
                <option value="10:00">10:00</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="16:00">16:00</option>
                <option value="18:00">18:00</option>
                <option value="20:00">20:00</option>
                <option value="22:00">22:00</option>
            </select>
            <input type="text" name="nom" placeholder="Nom complet" class="border p-3 rounded-lg" required>
            <input type="tel" name="telephone" placeholder="Numéro de téléphone" class="border p-3 rounded-lg" required>
            <select class="border p-3 rounded-lg" name="nombre_personnes" required>
                <option value="" disabled selected hidden>Nombre de personnes</option>
                <option value="1">1 personne</option>
                <option value="2">2 personnes</option>
                <option value="3">3 personnes</option>
                <option value="4">4 personnes</option>
                <option value="5">5 personnes</option>
                <option value="6">6 personnes</option>
            </select>
            <select class="border p-3 rounded-lg" name="id_menu" required>
                <option value="" disabled selected hidden>Menu</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $row['id_menu']; ?>">
                        <?php echo htmlspecialchars($row['nom_menu']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="bg-[#ff6b6b] text-white p-4 rounded-lg col-span-2 hover:bg-opacity-80">
                Réserver une table
            </button>
        </form>
    </div>
</div>

</section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2020 Victory Template</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-[#ff6b6b]">Facebook</a>
                <a href="#" class="hover:text-[#ff6b6b]">Twitter</a>
                <a href="#" class="hover:text-[#ff6b6b]">LinkedIn</a>
            </div>
            <p class="mt-4 md:mt-0">Design: TemplateMo</p>
        </div>
    </footer>
</body>
</html>