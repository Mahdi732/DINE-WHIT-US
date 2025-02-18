<?php
include("/xampp/htdocs/DINE-WHIT-US/db.php");
session_start();
if ($_SESSION['user_email'] === "admin@gmail.com") {
    header("Location: menu.php");
    echo "<script>alert('oops');</script>";
}else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date_reservation = $_POST['date_reservation'];
        $heure_reservation = $_POST['heure_reservation'];
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $nombre_personnes = intval($_POST['nombre_personnes']);
        $id_menu = intval($_POST['id_menu']);
        $id_client = $_SESSION['user_id'] ?? null;
        if (!$id_client) {
            header("Location: login.php");
            die();
            
        }
        $sql = "INSERT INTO reservations (id_client, id_menu, date_reservation, heure_reservation, nombre_personnes) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iissi", $id_client, $id_menu, $date_reservation, $heure_reservation, $nombre_personnes);
            if (mysqli_stmt_execute($stmt)) {
                header("location: user.php");
            } else {
                echo "Erreur lors de la réservation : " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Erreur lors de la préparation de la requête : " . mysqli_error($conn);
        }
    
        mysqli_close($conn);
    }
}

?>
