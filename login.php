<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#ff6b6b',
                        'secondary': '#333333'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f0f0f0] bg-[url('img/book-bg.jpg')] bg-cover bg-no-repeat">
<header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-[#ff6b6b]">Victory</a>
            <nav>
                <ul class="flex space-x-6">
                <li><a href="index.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Accueil</a></li>
                <li><a href="menu.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Menus</a></li>
                <li><a href="login.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">Login</a></li>
                <li><a href="profile.php" class="text-accent hover:text-red-400 transition-all duration-300 transform ">profile</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="w-full mx-auto my-8 max-w-md">
        <div class="bg-white shadow-xl rounded-2xl  overflow-hidden border border-gray-200">
            <div class="flex">
                <button id="loginTab" class="w-1/2 py-4 text-center bg-gray-100 font-semibold text-gray-700 hover:bg-gray-200 transition-colors active-tab" onclick="showLogin()">
                    Login
                </button>
                <button id="signupTab" class="w-1/2 py-4 text-center font-semibold text-gray-700 hover:bg-gray-100 transition-colors" onclick="showSignup()">
                    Sign Up
                </button>
            </div>

            <!-- Login Form -->
            <div id="loginForm" class="p-8">
                <h2 class="text-2xl font-bold text-center mb-6 text-secondary">Welcome Back</h2>
                
                <form method="POST" >
                    <div class="mb-4">
                        <label for="loginEmail" class="block text-secondary text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" id="loginEmail" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter your email">
                    </div>
                    
                    <div class="mb-6">
                        <label for="loginPassword" class="block text-secondary text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" id="loginPassword" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter your password">
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-primary">
                            <span class="ml-2 text-secondary text-sm">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-primary hover:underline">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary text-white py-2 rounded-md hover:opacity-90 transition-colors">
                        Login
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-secondary text-sm">Or login with</p>
                    <div class="flex justify-center space-x-4 mt-4">
                        <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:opacity-90 transition-colors">
                            Google
                        </button>
                        <button class="bg-blue-800 text-white px-4 py-2 rounded-md hover:opacity-90 transition-colors">
                            Facebook
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sign Up Form -->
            <div id="signupForm" class="p-8 hidden">
                <h2 class="text-2xl font-bold text-center mb-6 text-secondary">Create an Account</h2>
                <form method="POST" >
                    <div class="mb-4 flex justify-between">
                        <div class="flex flex-col">
                        <label for="signupName" class="block text-secondary text-sm font-bold mb-2"> Name</label>
                        <input name="name" type="text" id="signupName" class="w-[11rem] px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Enter your name">
                        </div>
                        <div class="flex flex-col">
                        <label for="" class="block text-secondary text-sm font-bold mb-2"> Prenom</label>
                        <input name="prenom" type="text" id="signupPrenom" class="w-[11rem] px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Enter your prenom">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="signupEmail" class="block text-secondary text-sm font-bold mb-2">Email</label>
                        <input name="email" type="email" id="signupEmail" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Enter your email">
                    </div>
                    
                    <div class="mb-4">
                        <label for="signupPassword" class="block text-secondary text-sm font-bold mb-2">Password</label>
                        <input  type="password" id="signupPassword" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Create a password">
                    </div>
                    
                    <div class="mb-6">
                        <label for="confirmPassword" class="block text-secondary text-sm font-bold mb-2">Confirm Password</label>
                        <input name="password" type="password" id="confirmPassword" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Confirm your password">
                    </div>
                    
                    <label class="flex items-center mb-6">
                        <input type="checkbox" id="check" class="form-checkbox h-4 w-4 text-secondary">
                        <span class="ml-2 text-secondary text-sm">I agree to the Terms and Conditions</span>
                    </label>
                    
                    <button type="submit" id="try" class="w-full bg-secondary text-white py-2 rounded-md hover:opacity-90 transition-colors">
                        Sign Up
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-secondary text-sm">Or sign up with</p>
                    <div class="flex justify-center space-x-4 mt-4">
                        <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:opacity-90 transition-colors">
                            Google
                        </button>
                        <button class="bg-blue-800 text-white px-4 py-2 rounded-md hover:opacity-90 transition-colors">
                            Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
include("/xampp/htdocs/dinewhitus/db.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO client (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
    $sqlstmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($sqlstmt, "ssss", $name, $prenom, $email, $password);
    $sqlexecute = mysqli_stmt_execute($sqlstmt);
    if (!$sqlexecute) {
        echo 'error' . mysqli_stmt_error($sqlstmt);
    }
}
?>
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
<script src="js/main.js"></script>
</body>
</html>