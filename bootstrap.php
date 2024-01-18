<?php

if (isset($_COOKIE['PHPSESSID'])) {
    @session_start();
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: /');
    exit;
}

$isLoggedIn = isset($_SESSION['user']);
