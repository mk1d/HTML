<?php
require_once 'services/db.php';
require_once 'services/auth.php';

// Fetch all messages ordered by newest first
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$stmt = $db->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - vaszilijedc.hu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include './components/nav.php'; ?>
    <div class="container py-5">
        <header class="mb-4 text-center">
            <h1 class="mb-3">Üzenetek</h1>
        </header>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Felhasználó</th>
                            <th>Név</th>
                            <th>Üzenet</th>
                            <th>Dátum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $index => $msg): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php
                                    if ($msg['user_id'] === null) {
                                        echo "Vendég";
                                    } else {
                                        // Lekérdezzük a felhasználó nevét
                                        $userStmt = $db->prepare("SELECT first_name, last_name FROM user WHERE id = ?");
                                        $userStmt->execute([$msg['user_id']]);
                                        $user = $userStmt->fetch(PDO::FETCH_ASSOC);
                                        echo $user
                                            ? htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name'])
                                            : "Ismeretlen felhasználó";
                                    }
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($msg['name']) ?></td>
                                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                                <td><?= htmlspecialchars($msg['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>