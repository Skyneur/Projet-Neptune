<?php

require_once __DIR__ . '/../../../database.php';
require_once __DIR__ . '/../../../_includes/guard_admin.php';
require_once __DIR__ . '/../../../_includes/admin_navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['number'])
        || !isset($_POST['expo'])

        || empty($_POST['number'])
        || empty($_POST['expo'])
    ) {
        die("Le formulaire n'est pas complet.");
    }




    $request = $pdo->prepare("
    INSERT INTO bedroom(number, bathroom, wc, expo, double_bed, single_bed, couch)
    VALUES(:number, :bathroom, :wc, :expo, :double_bed, :single_bed, :couch)"
    );
    $request->execute([
        'number' => $_POST['number'],
        'expo' => $_POST['expo'],
        'bathroom' => isset($_POST['bathroom']),
        'wc' => isset($_POST['wc']),
        'double_bed' => isset($_POST['double_bed']),
        'single_bed' => isset($_POST['single_bed']),
        'couch' => isset($_POST['couch']),
    ]);

    header('Location: /admin/chambres/chambres.php');
    exit;

}

// Variables pour le template
$navbar = new Navbar();

include __DIR__ . '/../../../_includes/document_start.php';
?>

    <div class="bg-body-tertiary pt-5">
        <div class="container bg-body-tertiary">
            <h1 class="">Administration de l'hotel</h1>
        </div>
        <?php echo $navbar->render('chambres'); ?>
    </div>

    <div class="container my-2">
        <h3>Ajouter une nouvelle chambre</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="number">Numéro de chambre</label>
                        <input
                            class="form-control"
                            type="number"
                            id="number"
                            name="number"
                            min="0"
                            required
                        >
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="bathroom" id="bathroom" class="form-check-input">
                        <label for="bathroom" class="form-check-label">Salle de bain</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="wc" id="wc" class="form-check-input">
                        <label for="wc" class="form-check-label">Toilettes</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="couch" id="couch" class="form-check-input">
                        <label for="couch" class="form-check-label">Canapé</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="single_bed" id="single-bed" class="form-check-input">
                        <label for="single-bed" class="form-check-label">Lit simple</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="double_bed" id="double-bed" class="form-check-input">
                        <label for="double-bed" class="form-check-label">Lit double</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="expo">Exposition</label>
                        <select class="form-select" name="expo" id="expo" required>
                            <option value="" disabled selected>Choisir une Exposition</option>
                            <option value="0">Nord</option>
                            <option value="1">Est</option>
                            <option value="2">Sud</option>
                            <option value="3">Ouest</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Ajouter
                </button>
            </div>
        </form>
    </div>

<?php include __DIR__ . '/../../../_includes/document_end.php'; ?>