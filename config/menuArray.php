<?php
return [
    [
        'name' => 'Főoldal',
        'post_name' => 'main',
        'is_visible' => function () {
            return ($_GET['page'] ?? 'home') !== 'home';
        }
    ],
    [
        'name' => 'Késeink',
        'post_name' => 'knives',
        'is_visible' => function () {
            return true;
        }
    ],
    [
        'name' => 'Kapcsolat',
        'post_name' => 'contact',
        'is_visible' => function () {
            return true;
        }
    ],
    [
        'name' => 'Üzenetek',
        'post_name' => 'messages',
        'is_visible' => function () {
            return true;
        }
    ],
    [
        'name' => 'Kilépés',
        'post_name' => 'logout',
        'is_button' => true,
        'is_visible' => function () {
            return isLoggedIn();
        }
    ],
    [
        'name' => 'Belépés',
        'post_name' => 'login',
        'is_visible' => function () {
            return !isLoggedIn() && ($_GET['page'] ?? '') !== 'login';
        },
        'is_button' => true
    ]
];