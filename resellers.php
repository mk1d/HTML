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

if (isset($_POST['knives'])) {
    header("Location: knives.php");
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
  <button class="navb" type="submit" name="knives">Késeink</button>
  <button class="navb" type="submit" name="logout">Kijelentkezés</button>
  </form>
<?php endif; ?>
</nav>
<div class="jumbotron text-center" style="background-image: url('./images/front.jpg')">
  <h1>Vaszilijedc.hu</h1>
  <P>Kések, pengék és multi toolok egy helyen</P>
  <h1>Viszonteladóink</h1>
</div>

<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2"></div> <!-- bal szél -->
        <div class="col-sm-8 middle-block">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card h-20">
                        <img src="./images/bladeshop_icon.jpg" class="card-img-top" alt="Kép">
                        <div class="card-body">
                            <h5 class="card-title">Bladeshop</h5>
                            <p class="card-text">Késes webshop gyakori akciókkal és vevőbarát hozzáállással. Ha új kés kell, ne hagyd ki!</p>
                            <a href="https://www.bladeshop.hu/" class="btn btn-primary">Tovább</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card h-20">
                        <img src="./images/elemlampa_icon.jpg" class="card-img-top" alt="Kép">
                        <div class="card-body">
                            <h5 class="card-title">Elemlámpa blog</h5>
                            <p class="card-text">Minden, amit az elemlámpákról tudni szeretnél. Cikkek, bemutatók, illetve kuponok gyűjtőhelye.</p>                            </p>
                            <a href="https://elemlampablog.hu/" class="btn btn-primary">Tovább</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card h-20">
                        <img src="./images/kesvilag_icon.jpg" class="card-img-top" alt="Kép">
                        <div class="card-body">
                            <h5 class="card-title">Késvilág</h5>
                            <p class="card-text">Hazai bolt és webáruház, rendkívül széles termékválasztékkal. Debrecenben személyesen is válogathatsz!</p>
                            <a href="https://www.kesvilag.hu/" class="btn btn-primary">Tovább</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card h-20">
                        <img src="./images/zboss_icon.jpg" class="card-img-top" alt="Kép">
                        <div class="card-body">
                            <h5 class="card-title">ZBOSS</h5>
                            <p class="card-text">Kések, edc felszerelések, túra és sok egyéb. Hazai webáruház, ahol a vevők elégedettsége a legfontosabb.</p>
                            <a href="https://www.zboss.hu/" class="btn btn-primary">Tovább</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div> <!-- jobb szél -->
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 text-center"><a href="main.php" class="big-button btn btn-primary">Vissza a főoldalra</a></div>
        <div class="col-sm-2"></div>
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
