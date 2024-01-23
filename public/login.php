<?php

include_once __DIR__ . '/../bootstrap.php';

require_once __DIR__ . '/../database.php';

// Formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    if (
        empty($_POST['name']) ||
        empty($_POST['firstname']) ||
        empty($_POST['email']) ||
        empty($_POST['password'])
    ) {
        die("Le formulaire d'inscription n'est pas complet.");
    }

    // Vérifie si l'utilisateur existe déjà
    $request = $pdo->prepare('SELECT id FROM users u WHERE u.email = :email');
    $request->execute(['email' => $_POST['email']]);

    if ($request->fetch()) {
        die("L'utilisateur existe déjà.");
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

// Formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['register'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        die("Le formulaire de connexion n'est pas complet.");
    }

    // Vérifie si l'utilisateur existe
    $request = $pdo->prepare('SELECT * FROM users u WHERE u.email = :email');
    $request->execute(['email' => $_POST['email']]);

    if (!$result = $request->fetch()) {
        die("L'utilisateur n'existe pas.");
    }

    // Vérifie si le mot de passe est correct
    if (!password_verify($_POST['password'], $result['password'])) {
        die("La paire email/mot de passe est incorrecte.");
    }

    // Démarre la session
    session_start();
    $_SESSION['user'] = $result;

    header('Location: /');
    exit;
}

?>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Neptune</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link rel="icon" href="https://www.pngmart.com/files/22/Neptune-PNG-Pic.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/a07d46abc4.js" crossorigin="anonymous" defer></script>
</head>
<body>
<?php include __DIR__ . '/../_includes/navbar.php'; ?>
<div class="form-container sign-in-form">
    <div class="form-box sign-in-box">
        <h2>Se Connecter</h2>
                    <form action="" method="post">
            <div class="field">
                <i class="uil uil-at"></i>
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="field">
                <i class="uil uil-lock-alt"></i>
                <input class="password" type="password" placeholder="Mot De Passe" name="password" required>
                <div class="eye-btn"><i class="uil uil-eye-slash"></i></div>
            </div>
            <div class="forgot-link">
                <a href="">Mot de passe oublié?</a>
            </div>
            <input class="submit-btn" type="submit" value="Envoyer">
        </form>
        <div class="login-options">
            <p class="text">Se connecter avec</p>
            <div class="other-logins">
                <a href=""><img src="images/google.png" alt=""></a>
                <a href=""><img src="images/facebook.png" alt=""></a>
                <a href=""><img src="images/apple.png" alt=""></a>
            </div>
        </div>
    </div>
    <div class="imgBox sign-in-imgBox">
        <div class="sliding-link">
            <p>Vous n'avez pas de compte ?</p>
            <span class="sign-up-btn">S'inscrire</span>
        </div>
        <img src="images/signin-img.png" alt="">
    </div>
</div>

<div class="form-container sign-up-form">
    <div class="imgBox sign-up-imgBox">
        <div class="sliding-link">
            <p>Vous avez déjà un compte ?</p>
            <span class="sign-in-btn">Se Connecter</span>
        </div>
        <img src="images/signup-img.png" alt="">
    </div>
    <div class="form-box sign-up-box">
        <h2>S'inscrire</h2>
        <div class="login-options">
            <div class="other-logins">
                <a href=""><img src="images/google.png" alt=""></a>
                <a href=""><img src="images/facebook.png" alt=""></a>
                <a href=""><img src="images/apple.png" alt=""></a>
            </div>
            <p class="text">Se connecter avec un mail<p>
        </div>
                    <form action="" method="post">
                        <input type="hidden" name="register" value="1">

            <div class="field">
                <i class="uil uil-at"></i>
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="field">
                <i class="uil uil-user"></i>
                <input type="text" placeholder="Nom" name="name" required>
            </div>
                        <div class="field">
                <i class="uil uil-user"></i>
                <input type="text" placeholder="Prénom" name="firstname" required>
            </div>
            <div class="field">
                <i class="uil uil-lock-alt"></i>
                <input type="password" placeholder="Mot De Passe" name="password" required>
            </div>
            <input class="submit-btn" type="submit" value="Envoyer">
        </form>
    </div>
</div>

<script>
    //input fields focus effects
    const textInputs = document.querySelectorAll("input");

    textInputs.forEach(textInput => {
        textInput.addEventListener("focus", () => {
            let parent = textInput.parentNode;
            parent.classList.add("active");
        });

        textInput.addEventListener("blur", () => {
            let parent = textInput.parentNode;
            parent.classList.remove("active");
        });
    });

    //password show/hide button
    const passwordInput = document.querySelector(".password-input");
    const eyeBtn = document.querySelector(".eye-btn");

    eyeBtn.addEventListener("click", () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeBtn.innerHTML = "<i class='uil uil-eye'></i>";
        } else {
            passwordInput.type = "password";
            eyeBtn.innerHTML = "<i class='uil uil-eye-slash'></i>";
        }
    });

    //sliding between sign-in form and sign-up form
    const signUpBtn = document.querySelector(".sign-up-btn");
    const signInBtn = document.querySelector(".sign-in-btn");
    const signUpForm = document.querySelector(".sign-up-form");
    const signInForm = document.querySelector(".sign-in-form");

    signUpBtn.addEventListener("click", () => {
        signInForm.classList.add("hide");
        signUpForm.classList.add("show");
        signInForm.classList.remove("show");
    });

    signInBtn.addEventListener("click", () => {
        signInForm.classList.remove("hide");
        signUpForm.classList.remove("show");
        signInForm.classList.add("show");
    });

    // Check URL on page load
    window.onload = function() {
        var urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('register')) { // Changed to 'register'
            signInForm.classList.add("hide");
            signUpForm.classList.add("show");
            signInForm.classList.remove("show");
        }
    }
</script>

</body>
</html>