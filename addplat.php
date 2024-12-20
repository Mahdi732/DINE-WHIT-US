<?php
include("/xampp/htdocs/dinewhitus/db.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image_path = "";
    $id_chef = $_SESSION['is_admin'] ? $_SESSION['user_id'] : ($_SESSION['user_id'] ?? null);

    if (!$id_chef) {
        die("Error: User not authenticated or invalid session.");
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "/uploads/"; 
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . $upload_dir; 
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = uniqid() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $file_name;
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $upload_dir . $file_name;
            } else {
                die("Error uploading the image.");
            }
        } else {
            die("Invalid file type. Please upload an image.");
        }
    } else {
        die("Image upload failed. Please try again.");
    }

    $sql = "INSERT INTO plats (nom_plat, prix,image ) VALUES (?, ?, ?)";
    $sqlstmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($sqlstmt, "sds", $name, $price, $image_path);
    if (mysqli_stmt_execute($sqlstmt)) {
        header("Location: admin.php");
    } else {
        echo "Erreur: " . mysqli_stmt_error($sqlstmt);
    }
}
?>
