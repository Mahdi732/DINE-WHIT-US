<?php
include("/xampp/htdocs/DINE-WHIT-US/db.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["delete"] ?? null;
    echo "$id";
    $sql = "DELETE FROM menus WHERE id_menu = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (!mysqli_stmt_execute($stmt)) {
       echo "not found"; 
    }
};

?>