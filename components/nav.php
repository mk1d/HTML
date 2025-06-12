<?php
$menuItems = require __DIR__ . '/../config/menuArray.php';
$email = getFullname();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($menuItems as $item): ?>
                    <?php if ($item['is_visible']()): ?>
                        <li class="nav-item">
                            <form method="post" class="d-inline">
                                <!-- tombbol generalt navigacios elemek 
                                -->
                                <button class="btn <?= !empty($item['is_button']) ? 'btn-primary' : 'btn-link nav-link' ?>"
                                    type="submit" name="<?= htmlspecialchars($item['post_name']) ?>">
                                    <?= htmlspecialchars($item['name']) ?>
                                </button>
                            </form>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <?php if (isLoggedIn()): ?>
                <span class="navbar-text" style="color: black;">
                    Bejelentkezett: <?= htmlspecialchars(getFullname()) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</nav>