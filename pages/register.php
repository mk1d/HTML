<?php
require_once 'services/db.php';
require_once 'services/auth.php';
$error = '';

// csak vendegeknek
//
if (isLoggedIn()) {
  header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm = $_POST['confirm_password'] ?? '';
  $fname = $_POST['fname'] ?? '';
  $lname = $_POST['lname'] ?? '';

  if ($password !== $confirm) {
    $error = "A jelszavak nem egyeznek.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Érvénytelen email-cím.";
  } else {
    try {
      $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
      $stmt->execute([$email]);

      if ($stmt->fetch()) {
        $error = "Ez az email már foglalt.";
      } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert = $db->prepare("INSERT INTO user (email, password, first_name, last_name) VALUES (?, ?, ?, ?)");
        $insert->execute([$email, $hashedPassword, $fname, $lname]);

        // ugrás a bejelentkezésre regisztráció után
        //
        header("Location: index.php?page=login");
        exit;
      }
    } catch (PDOException $e) {
      $error = "Adatbázis hiba: " . $e->getMessage();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./css/login.css">
</head>

<body>
  <?php include './components/nav.php'; ?>
  <div class="container py-5">
    <header class="mb-4 text-center">
      <h1 class="mb-3">Regisztráció</h1>
      <a href="index.php?page=login" class="text-decoration-none">Ha van már fiókod, jelentkezz be itt.</a>
    </header>

    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <form action="index.php?page=register" method="POST" class="p-4 border rounded shadow-sm bg-light">

          <div class="mb-3">
            <label for="email" class="form-label">Email cím:</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="lname" class="form-label">Család név:</label>
            <input type="text" name="lname" id="lname" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="fname" class="form-label">Utónév:</label>
            <input type="text" name="fname" id="fname" class="form-control" required>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="password" class="form-label">Jelszó:</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="confirm_password" class="form-label">Jelszó újra:</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
          </div>

          <div class="d-grid">
            <button type="submit" name="register" id="submit" class="btn btn-primary">Regisztráció</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>