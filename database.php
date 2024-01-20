<?php

$dbPath = __DIR__ . '/data.db';

$pdo = new PDO('sqlite:' . $dbPath, '', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);