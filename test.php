<?php

require_once __DIR__ . '/../../database.php';

$email = 'test@example.com'; // Remplacer avec votre email

$query = $pdo->prepare("
    UPDATE users SET isAdmin = 1 WHERE email = :email
");

$query->execute([
    'email' => $email
]);

echo "L'utilisateur $email est maintenant administrateur.";