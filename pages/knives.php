<?php
require_once 'services/db.php';
require_once 'services/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_knife'])) {
  // inputok validalasa es bejelenetkezett felhasznalo ellenorzes
  //
  if (!isLoggedIn()) {
    die("Hozzáférés megtagadva.");
  }

  $knifeName = $_POST['knife_name'] ?? '';
  $brandId = $_POST['brand_id'] ?? '';

  if (empty($knifeName) || empty($brandId)) {
    die("Kérjük, tölts ki minden mezőt.");
  }

  if (isset($_FILES['knife_image']) && $_FILES['knife_image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['knife_image']['tmp_name'];
    $fileName = basename($_FILES['knife_image']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // csak ezeket a fajl tipusokat engedelyezzuk
    //
    $allowedExts = ['png', 'jpg', 'jpeg'];
    if (!in_array($fileExt, $allowedExts)) {
      die("csak jpg es png fajlok engedelyezettek");
    }

    $newFileName = uniqid('knife_', true) . '.' . $fileExt;
    $destination = dirname(__DIR__) . '/uploads/' . $newFileName;

    if (move_uploaded_file($fileTmpPath, $destination)) {
      $imageUrl = 'uploads/' . $newFileName;

      $stmt = $db->prepare(query: "INSERT INTO knives (brand_id, name, image_url) VALUES (?, ?, ?)");

      $stmt->execute([$brandId, $knifeName, $imageUrl]);

      echo "<script>alert('Sikeres feltoltes');</script>";
    } else {
      echo "Hiba tortent a fajl mentesekor.";
    }
  } else {
    echo "Kep feltöltése kotelezo.";
  }
}

$sql = "SELECT k.name AS knife_name, k.image_url, b.name AS brand_name 
        FROM knives k 
        JOIN brands b ON k.brand_id = b.id 
        ORDER BY k.id DESC";

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
    height: 250px;
    /* Fix magasság */
    object-fit: cover;
    /* A kép kitölti a teret, miközben megőrzi az arányokat */
  }

  /* Opcionálisan: A kártyák egyenlő magasságúak legyenek */
  .card-body {
    min-height: 180px;
    /* Minimális magasság a kártyáknak */
  }
</style>

<body>
  <?php include './components/nav.php'; ?>
  <div class="jumbotron text-center" style="background-image: url('./images/front.jpg')">
    <h1>Vaszilijedc.hu</h1>
    <P>Kések, pengék és multi toolok egy helyen</P>
  </div>

  <div class="container">
    <h1 class="text-center my-4">Kések és Márkák</h1>

    <div class="row mb-2">
      <?php if (isLoggedIn()): ?>
        <form method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2 border-1">
          <label for="knife_name">Kés neve</label>
          <input type="text" id="knife_name" name="knife_name" />
          <label for="brand_id">Kés márkája</label>
          <select name="brand_id" required class="p-1">
            <?php
            // kerjuk le az osszes letezo brand-et
            //
            $stmt = $db->query("SELECT id, name FROM brands ORDER BY name");
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $brand) {
              echo '<option value="' . htmlspecialchars($brand['id']) . '">' . htmlspecialchars($brand['name']) . '</option>';
            }
            ?>
          </select>
          <input type="file" name="knife_image" accept="image/png, image/jpeg" />
          <input type="submit" value="Feltöltés" name="upload_knife" class="align-self-end"  />
        </form>
      <?php else: ?>
        <!-- csak bejelenetkezett felhasznalo -->
        <span style="color:red;">Bejelentkezés szükséges a feltöltéshez.</span>
      <?php endif; ?>
    </div>

    <div class="row">
      <?php foreach ($knives as $knife): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= htmlspecialchars($knife['image_url']); ?>" class="card-img-top"
              alt="<?= htmlspecialchars($knife['knife_name']); ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($knife['knife_name']); ?></h5>
              <p class="card-text">Márka: <?= htmlspecialchars($knife['brand_name']); ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php include './components/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>

</html>