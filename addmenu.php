<?php
include("/xampp/htdocs/dinewhitus/db.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_name = mysqli_real_escape_string($conn, $_POST["name"]);
    $plats = $_POST["plats"] ?? [];
    $image_path = "";

    $id_chef = $_SESSION['is_admin'] ? $_SESSION['user_id'] : ($_SESSION['user_id'] ?? null);

    if (!$id_chef) {
        die("Error: User not authenticated or invalid session.");
    }

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                die("Error: Failed to create the uploads directory.");
            }
        }
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            die("Error: Unable to save the uploaded file. Check folder permissions or file size.");
        }
    }

    $query = "INSERT INTO menus (id_chef, nom_menu, image_menu) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iss", $id_chef, $menu_name,$image_path);
    if (!mysqli_stmt_execute($stmt)) {
        die("Error: " . mysqli_error($conn));
    }

    $menu_id = mysqli_insert_id($conn);

    if ($menu_id && !empty($plats)) {
        $query = "UPDATE plats SET id_menu = ? WHERE id_plat = ?";
        $stmt = mysqli_prepare($conn, $query);
        foreach ($plats as $plat_id) {
            mysqli_stmt_bind_param($stmt, "ii", $menu_id, $plat_id);
            if (!mysqli_stmt_execute($stmt)) {
                die("Error: " . mysqli_error($conn));
            }
        }
    }
}
?>
