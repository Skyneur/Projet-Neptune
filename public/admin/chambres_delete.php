<?php

require_once __DIR__ . '/../../database.php';
require_once __DIR__ . '/../../_includes/guard_admin.php';
require_once __DIR__ . '/../../_includes/admin_navbar.php';

// Récupération de la chambre si elle existe
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("L'identifiant de la chambre est manquant.");
}

$request = $pdo->prepare('SELECT * FROM bedroom b WHERE b.id = :id');
$request->execute([
    'id' => $_GET['id'],
]);

if (!$chambre = $request->fetch()) {
    die("Il n'y a pas de chambre pour l'ID {$_GET['id']}.");
}

// Traitement formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = $pdo->prepare('DELETE FROM bedroom WHERE id = :id');
    $request->execute(['id' => $_GET['id']]);

    header('Location: /admin/chambres.php');
    exit;
}

// Variables pour le template
$navbar = new Navbar();

include __DIR__ . '/../../_includes/document_start.php';
?>

<div class="bg-body-tertiary pt-5">
    <div class="container bg-body-tertiary">
        <h1 class="">Administration de l'hotel</h1>
    </div>
    <?php echo $navbar->render('chambres'); ?>
</div>

<div class="container my-2">
    <h2>Ajouter une nouvelle chambre</h2>

    <form action="" method="post">
        <div class="mx-auto my-5" style="max-width: 20rem;">
            <div class="alert alert-danger">
                <p class="mb-0">
                    Êtes-vous sûr de vouloir supprimer la chambre numéro 
                    <?php echo $chambre['number']; ?>
                    ?
                </p>
                <div class="text-end">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash-alt"></i>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../_includes/document_end.php'; ?>
