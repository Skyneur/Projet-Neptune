<?php require_once __DIR__ . '/../bootstrap.php'; ?>
<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fa-duotone fa-house fa-lg"  style="--fa-primary-color: #FF8F87; --fa-secondary-color: #D64980;"></i>
            Hotel Neptune
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/../users/chambres/chambres.php">
                        <i class="fa-duotone fa-bed fa-lg"  style="--fa-primary-color: #FF8F87; --fa-secondary-color: #D64980;"></i>
                        Chambres
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-duotone fa-user fa-lg" style="--fa-primary-color: #FF8F87; --fa-secondary-color: #D64980;"></i>
                        <?php echo $isLoggedIn ? $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['name'] : ''; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if ($isLoggedIn) { ?>
                        <li>
                            <a href="/profile.php" class="dropdown-item">
                                <i class="fa-solid fa-fw fa-circle-user"></i>
                                Mon profil
                            </a>
                        </li>
                        <?php if ($isAdmin) { ?>
    <a href="/admin.php" class="dropdown-item">
        <i class="fa-solid fa-fw fa-user-shield"></i>
        Administration
    </a>
<?php } ?>
                        <li>
                            <a href="?action=logout" class="dropdown-item">
                                <i class="fa-solid fa-fw fa-power-off"></i>
                                Déconnexion
                            </a>
                        </li>
                        <?php } else { ?>
                        <li>
                            <a class="dropdown-item" href="/login.php">
                                <i class="fa-solid fa-fw fa-arrow-right-to-bracket"></i>
                                Se connecter
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/login.php?register=1">
                                <i class="fa-duotone fa-user-plus"  style="--fa-primary-color: #FF8F87; --fa-secondary-color: #D64980;"></i>
                                S'inscrire
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
