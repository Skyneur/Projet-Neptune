<?php

require_once __DIR__ . '/../../../database.php';
require_once __DIR__ . '/../../../_includes/guard_admin.php';
require_once __DIR__ . '/../../../_includes/admin_navbar.php';

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
    if (
        !isset($_POST['number'])
        || !isset($_POST['expo'])
        || empty($_POST['number'])
        || ($_POST['expo'] === "")
    ) {
        die("Le formulaire n'est pas complet.");
    }

    $request = $pdo->prepare('
        UPDATE bedroom 
        SET 
            number = :number,
            bathroom = :bathroom,
            wc = :wc, 
            expo = :expo, 
            double_bed = :double_bed, 
            single_bed = :single_bed, 
            couch = :couch,
            image = :image
        WHERE id = :id
    ');

    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Le fichier a été téléchargé.";
    } else {
        echo "Erreur de téléchargement du fichier.";
    }

    $path = $_FILES['image']['name'];

    $request->execute([
        'number' => $_POST['number'],
        'expo' => $_POST['expo'],
        'bathroom' => isset($_POST['bathroom']) ? 1 : 0,
        'wc' => isset($_POST['wc']),
        'double_bed' => isset($_POST['double_bed']),
        'single_bed' => isset($_POST['single_bed']),
        'couch' => isset($_POST['couch']),
        'image' => $path,
        'id' => $_GET['id'],
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
    <h2>Modifier une chambre</h2>

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
                        value="<?php echo $chambre['number']; ?>"
                        required
                    >
                </div>

                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="bathroom"
                        id="bathroom"
                        class="form-check-input"
                        <?php echo $chambre['bathroom'] ? 'checked' : ''; ?>
                    >
                    <label for="bathroom" class="form-check-label">Salle de bain</label>
                </div>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="wc"
                        id="wc"
                        class="form-check-input"
                        <?php echo $chambre['wc'] ? 'checked' : ''; ?>
                    >
                    <label for="wc" class="form-check-label">Toilettes</label>
                </div>

                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="double_bed"
                        id="double-bed"
                        class="form-check-input"
                        <?php echo $chambre['double_bed'] ? 'checked' : ''; ?>
                    >
                    <label for="double-bed" class="form-check-label">Lit double</label>
                </div>

                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="single_bed"
                        id="single-bed"
                        class="form-check-input"
                        <?php echo $chambre['single_bed'] ? 'checked' : ''; ?>
                    >
                    <label for="single-bed" class="form-check-label">Lit simple</label>
                </div>

                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="couch"
                        id="couch"
                        class="form-check-input"
                        <?php echo $chambre['couch'] ? 'checked' : ''; ?>
                    >
                    <label for="couch" class="form-check-label">Canapé</label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-2">
                    <label for="expo">Exposition</label>
                    <select class="form-select" name="expo" id="expo" required>
                        <option value="" disabled selected>Choisir une Exposition</option>
                        <option value="0" <?php echo $chambre['expo'] === 0 ? 'selected' : '' ?>>Nord</option>
                        <option value="1" <?php echo $chambre['expo'] === 1 ? 'selected' : '' ?>>Est</option>
                        <option value="2" <?php echo $chambre['expo'] === 2 ? 'selected' : '' ?>>Sud</option>
                        <option value="3" <?php echo $chambre['expo'] === 3 ? 'selected' : '' ?>>Ouest</option>
                    </select>
                </div>
                <label for="image">Image de la chambre</label>
                <br>
                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                    <?php echo $chambre['image'] ? 'checked' : ''; ?>
                >
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-edit"></i>
                Modifier
            </button>
        </div>
</div>


<?php include __DIR__ . '/../../../_includes/document_end.php'; ?>
