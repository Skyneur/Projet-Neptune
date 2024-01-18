<?php

require_once __DIR__ . '/../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification qu'on a toutes les infos nécessaires
    if (
        (!isset($_POST['email']) || !isset($_POST['password']))
        || (empty($_POST['email']) || empty($_POST['password']))
    ) {
        die("Le formulaire n'est pas complet. ");
    }

    // On vérifie que l'utilisateur existe
    $request = $pdo->prepare('SELECT * FROM users u WHERE u.email = :email');
    $request->execute(['email' => $_POST['email']]);

    if (!$result = $request->fetch()) {
        die("L'utilisateur n'existe pas.");
    }

    // On vérifie si le mot de passe est bon
    if (!password_verify($_POST['password'], $result['password'])) {
        die("La paire email/mot de passe est incorrecte.");
    }

    // On démarre la session
    session_start();
    $_SESSION['user'] = $result;

    header('Location: /');
    exit;
}

?>
<?php include __DIR__ . '/../_includes/document_start.php'; ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container my-5">
        <div class="mx-auto" style="max-width: 30rem;">
            <div class="card bg-body-tertiary">
                <div class="card-body">
                    <div class="login-header" style="display: flex; align-items: center;">
                        <h1 style="margin-right: 10px;">Se connecter</h1>
                        <img src="https://www.pngmart.com/files/22/Neptune-PNG-Pic.png" style="width: 35px;">
                    </div>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Se connecter
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background: url('/images/5.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .card-body {
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.85);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(100, 128, 128, 0.7);
        }
    </style>
<?php include __DIR__ . '/../_includes/document_end.php'; ?>