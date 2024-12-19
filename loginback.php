<?php
session_start();
include("/xampp/htdocs/dinewhitus/db.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email_login = $_POST["email_login"];
    $password_login = $_POST["password_login"];

    $sql = "SELECT * FROM client WHERE email = ? AND mot_de_passe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email_login, $password_login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        if ($email_login === "admin@gmailcom" && $password_login === "admin") {
            header("Location: admin.php");
        } else {
            header("Location: user.php");
        }
        exit;
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>
