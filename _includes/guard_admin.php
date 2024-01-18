<?php

require_once __DIR__ . '/../bootstrap.php';

if (!$isAdmin) {
    header('Location: /');
    exit;
}