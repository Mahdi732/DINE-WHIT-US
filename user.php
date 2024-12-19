<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
    <header class="fixed w-full top-0 z-50 glass-morphism shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4 animate-fade-in-down">
                <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                    <span class="text-white font-bold">JD</span>
                </div>
                <span class="text-2xl font-bold text-accent tracking-wider">John Doe</span>
            </div>
            <nav>
                <ul class="flex space-x-6">
                <li><a href="index.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Accueil</a></li>
                <li><a href="menu.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Menus</a></li>
                <li><a href="login.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 pt-24 pb-12 flex-grow">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-1 glass-morphism p-6 rounded-2xl shadow-2xl transform transition-all duration-500 hover:scale-105 animate-fade-in-down">
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto bg-secondary rounded-full flex items-center justify-center mb-4">
                        <span class="text-4xl text-white font-bold">JD</span>
                    </div>
                    <h2 class="text-2xl font-bold text-accent mb-2">John Doe</h2>
                    <p class="text-sm opacity-75 mb-4">Regular Customer</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div>
                            <div class="text-accent font-bold">42</div>
                            <div class="text-xs opacity-75">Visits</div>
                        </div>
                        <div>
                            <div class="text-accent font-bold">15</div>
                            <div class="text-xs opacity-75">Reservations</div>
                        </div>
                        <div>
                            <div class="text-accent font-bold">3</div>
                            <div class="text-xs opacity-75">Ongoing</div>
                        </div>
                    </div>
                    
                    <button class="bg-secondary text-white px-6 py-2 rounded-full hover:bg-accent transition-all duration-300 transform hover:scale-105">
                        Edit Profile
                    </button>
                </div>
            </div>

            <div class="md:col-span-2 glass-morphism p-6 rounded-2xl">
                <h3 class="text-2xl font-bold text-accent mb-6">Reservation History</h3>
                <div class="space-y-4">
                    <div class="bg-dark-blue p-4 rounded-xl flex justify-between items-center">
                        <div>
                            <div class="font-bold text-accent">Restaurant Gastronomique</div>
                            <div class="text-sm opacity-75">May 15, 2024 | 7:30 PM | 4 Persons</div>
                        </div>
                        <div class="flex space-x-2">
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">Completed</span>
                            <button class="bg-accent text-primary px-3 py-1 rounded-full text-xs hover:opacity-80">Details</button>
                        </div>
                    </div>
                    <div class="bg-dark-blue p-4 rounded-xl flex justify-between items-center">
                        <div>
                            <div class="font-bold text-accent">Café Moderne</div>
                            <div class="text-sm opacity-75">June 2, 2024 | 12:00 PM | 2 Persons</div>
                        </div>
                        <div class="flex space-x-2">
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs">Pending</span>
                            <button class="bg-accent text-primary px-3 py-1 rounded-full text-xs hover:opacity-80">Details</button>
                        </div>
                    </div>
                    <div class="bg-dark-blue p-4 rounded-xl flex justify-between items-center">
                        <div>
                            <div class="font-bold text-accent">Bistro Parisien</div>
                            <div class="text-sm opacity-75">July 10, 2024 | 6:45 PM | 3 Persons</div>
                        </div>
                        <div class="flex space-x-2">
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs">Cancelled</span>
                            <button class="bg-accent text-primary px-3 py-1 rounded-full text-xs hover:opacity-80">Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3 glass-morphism p-6 rounded-2xl">
                <h3 class="text-2xl font-bold text-accent mb-6">Dining History</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-dark-blue p-4 rounded-xl text-center">
                        <div class="text-3xl font-bold text-accent mb-2">15</div>
                        <div class="text-sm opacity-75">Total Restaurants</div>
                    </div>
                    <div class="bg-dark-blue p-4 rounded-xl text-center">
                        <div class="text-3xl font-bold text-accent mb-2">€842</div>
                        <div class="text-sm opacity-75">Total Spent</div>
                    </div>
                    <div class="bg-dark-blue p-4 rounded-xl text-center">
                        <div class="text-3xl font-bold text-accent mb-2">4.6</div>
                        <div class="text-sm opacity-75">Average Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2024 User Dashboard</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-accent">Privacy Policy</a>
                <a href="#" class="hover:text-accent">Terms of Service</a>
                <a href="#" class="hover:text-accent">Contact Support</a>
            </div>
        </div>
    </footer>
</body>
</html>