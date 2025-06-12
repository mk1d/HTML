<?php
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function getEmail(): mixed
{
    return $_SESSION['email'] ?? null;
}

function getFullname(): mixed
{
    if (isset($_SESSION['first_name'], $_SESSION['last_name'])) {
        return $_SESSION['first_name'] . " " . $_SESSION['last_name'];
    }
    return null;
}

function getUserID(): mixed
{
    return $_SESSION['user_id'] ?? null;
}