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
                    <li><a href="login.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Login</a></li>
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
        <section class="grid md:grid-cols-2 gap-8 items-start">
            <div class="order-2 md:order-1">
                <img src="img/breakfast_menu.jpg" alt="Breakfast" class="w-full rounded-lg shadow-md">
            </div>
            <div class="order-1 md:order-2">
                <h2 class="text-3xl font-bold mb-6">Breakfast Menu</h2>
                <div class="space-y-4 ">
                    <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
                        <img src="img/breakfast_item.jpg" alt="Breakfast Item" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h4 class="font-bold text-xl">Kale Chips Art Party</h4>
                            <p class="text-gray-600">Dreamcatcher squid ennui cliche chicharros nes echo small batch jean ditcher meal...</p>
                            <span class="text-[#ff6b6b] font-bold">$3.50</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
                        <img src="img/breakfast_item.jpg" alt="Breakfast Item" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h4 class="font-bold text-xl">Kale Chips Art Party</h4>
                            <p class="text-gray-600">Dreamcatcher squid ennui cliche chicharros nes echo small batch jean ditcher meal...</p>
                            <span class="text-[#ff6b6b] font-bold">$3.50</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
                        <img src="img/breakfast_item.jpg" alt="Breakfast Item" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h4 class="font-bold text-xl">Kale Chips Art Party</h4>
                            <p class="text-gray-600">Dreamcatcher squid ennui cliche chicharros nes echo small batch jean ditcher meal...</p>
                            <span class="text-[#ff6b6b] font-bold">$3.50</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
                        <img src="img/lunch_item.jpg" alt="Lunch Item" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h4 class="font-bold text-xl">Drink Vinegar Prism</h4>
                            <p class="text-gray-600">Dreamcatcher squid ennui cliche chicharros nes echo small batch jean ditcher meal...</p>
                            <span class="text-[#ff6b6b] font-bold">$7.25</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
                        <img src="img/dinner_item.jpg" alt="Dinner Item" class="w-24 h-24 object-cover rounded-md mr-4">
                        <div>
                            <h4 class="font-bold text-xl">Taiyaki Gastro Tousled</h4>
                            <p class="text-gray-600">Dreamcatcher squid ennui cliche chicharros nes echo small batch jean ditcher meal...</p>
                            <span class="text-[#ff6b6b] font-bold">$11.50</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="bg-white md:w-auto h-[30rem] md:h-[40rem] md:py-16 flex flex-col md:flex-row md:justify-center items-center">
    <div class="bg-[url('img/book_left_image.jpg')] bg-cover bg-center h-[14rem] md:h-[26.7rem] w- md:w-[30rem] md:rounded-l-lg">
    </div>

    <div class="container w-auto items-center bg-[#e5e7eb] flex flex-col md:w-[30rem] p-8 shadow-md">
        <h2 class="text-4xl font-bold text-center mb-12">Réservez Votre Table</h2>
        <div class="w-auto md:max-w-4xl md:mx-auto">
            <form class="grid grid-cols-2 md:grid md:grid-cols-2 gap-6">
                <input class="border p-3 rounded-lg" type="date">
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