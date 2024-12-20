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
                <a href="admin.php" class="block py-2 px-4 text-accent hover:bg-secondary rounded-lg transition-all">
                    Profile
                </a>
            </nav>
        </div>
    </div>


</body>
</html>