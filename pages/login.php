<?php
require_once 'services/db.php';
require_once 'services/auth.php';

// csak vendegeknek
//
if (isLoggedIn()) {
  header("Location: index.php");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  try {
    $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
      $_SESSION['user_id'] = $user['ID'];
      $_SESSION['email'] = $user['Email'];
      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['last_name'] = $user['last_name'];

      header("Location: index.php");
      exit;
    } else {
      $error = "Hibás email vagy jelszó.";
    }
  } catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $error = "Adatbázis hiba történt. Kérlek, próbáld újra később.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bejelentkezés - vaszilijedc.hu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include './components/nav.php'; ?>
  <div class="container py-5">
    <header class="mb-4 text-center">
      <h1 class="mb-3">Bejelentkezés</h1>
      <a href="index.php?page=register" class="text-decoration-none">Ha még nincs saját felhasználód, itt tudsz
        regisztrálni.</a>
    </header>

    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <form action="index.php?page=login" method="POST" class="p-4 border rounded shadow-sm bg-light">

          <div class="mb-3">
            <label for="email" class="form-label">Email cím:</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Jelszó:</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>

          <?php if (!empty($error)): ?>
            <div class="mb-3 text-danger"><?php echo $error; ?></div>
          <?php endif; ?>

          <div class="d-grid">
            <button type="submit" id="submit" class="btn btn-primary">Bejelentkezés</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>