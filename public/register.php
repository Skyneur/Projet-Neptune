<?php

include_once __DIR__ . '/../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['name'])
        || !isset($_POST['firstname'])
        || !isset($_POST['email'])
        || !isset($_POST['password'])
        || !isset($_POST['password2'])

        || empty($_POST['name'])
        || empty($_POST['firstname'])
        || empty($_POST['email'])
        || empty($_POST['password'])
        || empty($_POST['password2'])
    ) {
        die("Le formulaire n'est pas complet.");
    }

    include_once __DIR__ . '/../database.php';

    // Est-ce que l'utilisateur existe déjà ?
    $request = $pdo->prepare('SELECT id FROM users u WHERE u.email = :email');
    $request->execute(['email' => $_POST['email']]);

    if ($request->fetch()) {
        die("L'utilisateur existe déjà.");
    }

    // Est-ce que les mots de passe correspondent ?
    if ($_POST['password'] !== $_POST['password2']) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Inscription
    $request = $pdo->prepare('INSERT INTO users(name, firstname, email, password) VALUES(:name, :firstname, :email, :password)');
    $request->execute([
        'name' => $_POST['name'],
        'firstname' => $_POST['firstname'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ]);

    header('Location: /login.php');
    exit;
}

?>
<?php include __DIR__ . '/../_includes/document_start.php'; ?>
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
                        <h1 style="margin-right: 10px;">Inscription</h1>
                        <img src="https://www.pngmart.com/files/22/Neptune-PNG-Pic.png" style="width: 35px;">
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstname">Prénom</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password2">Confirmation mot de passe</label>
                            <input type="password" name="password2" id="password2" class="form-control" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                S'inscrire
                            </button>
                        </div>
                    </form>
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