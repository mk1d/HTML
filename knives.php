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

$sql = "SELECT k.name AS knife_name, k.image_url, b.name AS brand_name 
        FROM knives k 
        JOIN brands b ON k.brand_id = b.id 
        ORDER BY b.name, k.name";

$stmt = $db->prepare($sql);
$stmt->execute();

$knives = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <title>Késeink - vaszilijedc.hu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
</head>

<style>
        /* A képek fix méretének beállítása */
        .card-img-top {
            width: 100%;
            height: 250px; /* Fix magasság */
            object-fit: cover; /* A kép kitölti a teret, miközben megőrzi az arányokat */
        }

        /* Opcionálisan: A kártyák egyenlő magasságúak legyenek */
        .card-body {
            min-height: 180px; /* Minimális magasság a kártyáknak */
        }
</style>

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
</div>

 <div class="container">
        <h1 class="text-center my-4">Kések és Márkák</h1>
        <div class="row">
            <?php foreach ($knives as $knife): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($knife['image_url']); ?>" class="card-img-top" alt="<?= htmlspecialchars($knife['knife_name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($knife['knife_name']); ?></h5>
                            <p class="card-text">Márka: <?= htmlspecialchars($knife['brand_name']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
  </div>

<br>
  <footer>
    <p>Készitő: Kullai Marcell, Baczúr Martin<br>
    <a href="https://github.com/mk1d">Github</a></p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>