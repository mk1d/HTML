<?php
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}
function getEmail(): mixed {
    return $_SESSION['email'] ?? null;
}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}