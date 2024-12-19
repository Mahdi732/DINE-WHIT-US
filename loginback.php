<?php
session_start();
include("/xampp/htdocs/dinewhitus/db.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email_login = $_POST["email_login"];
    $password_login = $_POST["password_login"];

    $sql = "SELECT * FROM client WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email_login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password_login, $user["mot_de_passe"])) {
            $_SESSION['user_id'] = $user['id_client'];
            $_SESSION['user_email'] = $user['email'];
            if ($email_login === "admin@gmail.com" && password_verify($password_login, $user["mot_de_passe"])) {
                header("Location: admin.php");
            } else {
                header("Location: user.php");
            }
            exit;

        } else {
            echo "<script>alert('Invalid credentials');git </script>";
        }
        }else 
        {
        echo "<script>alert('Invalid bobo');</script>";
        }
}
?>
