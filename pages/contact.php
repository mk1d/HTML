<?php
require_once 'services/db.php'; // $db PDO kapcsolat
require_once 'services/auth.php'; // getUserID() feltételezve

$error = '';

// szerver oldali validalas
//
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = trim($_POST['name'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // null, ha nincs bejelentkezve (vendeg)
    //
    $userId = getUserID();

    if (empty($name) || empty($message)) {
        $error = "Kérjük, tölts ki minden mezőt.";
    } else {
        $stmt = $db->prepare("INSERT INTO messages (user_id, name, message) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $name, $message]);

        echo "<script>alert('Uzenet elkuldve');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <title>Kapcsolat - vaszilijedc.hu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>

    <?php include './components/nav.php'; ?>

    <div class="container py-5">
        <header class="mb-4 text-center">
            <h1 class="mb-3">Kapcsolat űrlap</h1>
        </header>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="index.php?page=contact" method="POST" class="p-4 border rounded shadow-sm bg-light"
                    id="contactForm">

                    <div class="mb-3">
                        <label for="name" class="form-label">Név:</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Szöveg:</label>
                        <textarea name="message" id="message" class="form-control"></textarea>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="mb-3 text-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <div class="d-grid">
                        <button name="send_message" type="submit" class="btn btn-primary">Küldés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // kliensoldali foorm js validalas
        //
        document.getElementById('contactForm').addEventListener('submit', function (event) {
            const name = document.getElementById('name').value.trim();
            const message = document.getElementById('message').value.trim();

            if (!name || !message) {
                alert('Kérjük, tölts ki minden mezőt. (JS)');
                event.preventDefault();
            }
        });
    </script>
</body>

</html>