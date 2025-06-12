<?php
session_start();
require_once 'services/db.php';
require_once 'services/auth.php';

// eleresi utak
//
define('BASE_PATH', dirname(__DIR__));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php?page=home");
    exit();
  }

  // navigalas
  //
  if (isset($_POST['knives'])) {
    header("Location: index.php?page=knives");
    exit();
  }
  if (isset($_POST['messages'])) {
    header("Location: index.php?page=messages");
    exit();
  }
  if (isset($_POST['contact'])) {
    header("Location: index.php?page=contact");
    exit();
  }
  if (isset($_POST['login'])) {
    header("Location: index.php?page=login");
    exit();
  }
  if (isset($_POST['main'])) {
    header("Location: index.php?page=home");
    exit();
  }
}

// kerjuk le a "page" query stringet, ha nincs akkor automatikusan fooldal
//
$page = $_GET['page'] ?? 'home';

switch ($page) {
  case 'home':
    include 'pages/home.php';
    break;

  case 'knives':
    include 'pages/knives.php';
    break;

  case 'contact':
    include 'pages/contact.php';
    break;

  case 'login':
    include 'pages/login.php';
    break;

  case 'register':
    include 'pages/register.php';
    break;

  case 'resellers':
    include 'pages/resellers.php';
    break;

  case 'messages':
    include 'pages/messages.php';
    break;

  default:
    include 'pages/home.php';
    break;
}