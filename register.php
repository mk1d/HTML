<?php
session_start();
require_once 'services/db.php';
require_once 'services/auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $error = "A jelszavak nem egyeznek.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Érvénytelen email-cím.";
        $error = $email;
    } else {
        $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "Ez az email már foglalt.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = $db->prepare("INSERT INTO user (email, password) VALUES (?, ?)");

            $insert->execute([$email, $hashedPassword]);

            // Bejelentkezés regisztráció után
            $_SESSION['user_id'] = $db->lastInsertId();

            header("Location: index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció - vaszilijedc.hu</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Regisztráció</div>
      <div class="eula"><a href="index.php">Ha van már fiókod jelentkezz be itt.</a></div>
    </div>
    <div class="right">
      <form action="register.php" method="POST" class="form">
      <label for="email">Email cím:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" required>
            <label for="confirm_password">Jelszó újra:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        <input type="submit" id="submit" value="Submit">
        <br>
      </form>
    </div>
  </div>
</div>
</body>
</html>