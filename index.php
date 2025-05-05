<?php
session_start();
require_once 'services/db.php';
require_once 'services/auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare(query: "SELECT * FROM user WHERE email = ?");
    $stmt->execute(params: [$email]);
    $user = $stmt->fetch(mode: PDO::FETCH_ASSOC);

    if ($user && password_verify(password: $password, hash: $user['Password'])) {
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['email'] = $user['Email'];
        header(header: "Location: main.php");
        exit;
    } else {
        $error = "Hibás email vagy jelszó.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - vaszilijedc.hu</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Bejelentkezés</div>
      <div class="eula"><a href="register.php">Ha még nincs saját felhasználód itt tudsz regisztrálni.</a></div>
    </div>
    <div class="right">
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="index.php" method="POST" class="form">
            <label for="email">Email cím:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" id="submit"></input>
        </form>
    </div>
  </div>
</div>
</body>
</html>