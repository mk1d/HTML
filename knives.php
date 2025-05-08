<?php
session_start();
require_once 'services/db.php';
require_once 'services/auth.php';

if (!isLoggedIn()) {
    header("Location: index.php");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_POST['main'])) {
    header("Location: main.php");
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <title>Viszonteladók - vaszilijedc.hu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<nav>
<?php
$email = getEmail();
?>
<?php if ($email): ?>
  <span>Bejelentkezve mint, <?= $email ?></span>
<form method="post" style="display:inline;">
        <button class="navb" type="submit" name="main">Főoldal</button>
        <button class="navb" type="submit" name="logout">Kijelentkezés</button>
</form>
<?php endif; ?>
</nav>
<div class="jumbotron text-center" style="background-image: url('./images/front.jpg')">
  <h1>Vaszilijedc.hu</h1>
  <P>Kések, pengék és multi toolok egy helyen</P>
  <h1>Viszonteladóink</h1>
</div>

<!-- Ide rakosgasd be a kartyakat :) -->

<div class="container">
  <div class="row">
    <?php foreach ($resellers as $reseller): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($reseller['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($reseller['name']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($reseller['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($reseller['brand_id']) ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- xxxx -->

<br>
  <footer>
    <p>Készitő: Kullai Marcell, Baczúr Martin<br>
    <a href="https://github.com/mk1d">Github</a></p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
