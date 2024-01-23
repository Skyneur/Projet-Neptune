<?php

require_once __DIR__ . '/../../../database.php';
require_once __DIR__ . '/../../../_includes/guard_admin.php';
require_once __DIR__ . '/../../../_includes/admin_navbar.php';

$query = $pdo->query('SELECT * FROM bedroom');

// Variables pour le template
$navbar = new Navbar();
$chambres = $query->fetchAll();
$expo = ['Nord', 'Est', 'Sud', 'Ouest'];

// Par exemple, pour obtenir l'image de la première chambre :
$imageData = $chambres[0]['image'];

$base64Image = base64_encode($imageData);

include __DIR__ . '/../../../_includes/document_start.php';
?>

<div class="bg-body-tertiary pt-5">
    <div class="container bg-body-tertiary">
        <h1 class="">Administration de l'hotel</h1>
    </div>
    <?php echo $navbar->render('chambres'); ?>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col me-auto">
            <h2>Liste des chambres</h2>
        </div>
        <div class="col-auto">
            <a href="/admin/chambres/chambres_new.php" class="btn btn-primary rounded-pill">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive border rounded">
        <table class="table table-hover table-striped mb-0">
            <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Numéro</th>
                    <th style="text-align: center;">Exposition</th>
                    <th style="text-align: center;">Salle De Bain</th>
                    <th style="text-align: center;">WC</th>
                    <th style="text-align: center;">Lit double</th>
                    <th style="text-align: center;">Lit simple</th>
                    <th style="text-align: center;">Canapé</th>
                    <th style="text-align: center;">Photos</th>
                    <th style="text-align: center;">Actions</th>
            </tr>

            <?php foreach ($chambres as $chambre) { ?>
                <tr>
                    <td style="text-align: center;"><?php echo $chambre['id']; ?></td>
                    <td style="text-align: center;"><?php echo $chambre['number']; ?></td>
                    <td style="text-align: center;"><?php echo $expo[$chambre['expo']]; ?></td>
                    <td>
                        <?php if ($chambre['bathroom']) { ?>
                            <div style="text-align: center;">
                                <i class="fa-solid fa-check text-success"></i>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['wc']) { ?>
                            <div style="text-align: center;">
                                <i class="fa-solid fa-check text-success"></i>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['double_bed']) { ?>
                            <div style="text-align: center;">
                                <i class="fa-solid fa-check text-success"></i>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['single_bed']) { ?>
                            <div style="text-align: center;">
                                <i class="fa-solid fa-check text-success"></i>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['couch']) { ?>
                            <div style="text-align: center;">
                                <i class="fa-solid fa-check text-success"></i>
                            </div>
                        <?php } ?>
                    </td>
                    <td style="text-align: center;">
                    <?php if (!empty($chambre['image'])) { ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($chambre['image']); ?>" alt="Image de la chambre">
                    <?php } else { ?>
                        <div>Image invalide</div>
                    <?php } ?>
                </td>
                    <td style="text-align: center;">
                        <a
                            href="/admin/chambres/chambres_edit.php?id=<?php echo $chambre['id']; ?>"
                            class="icon-link"
                        >
                            <i class="fa-duotone fa-pen-to-square"
                               style="--fa-primary-color: #d64980; --fa-secondary-color: #ff8f87; --fa-secondary-opacity: 1;"></i>
                        </a>
                        <a
                            href="/admin/chambres/chambres_delete.php?id=<?php echo $chambre['id']; ?>"
                            class="icon-link text-danger"
                        >
                            <i class="fa-solid fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../../../_includes/document_end.php'; ?>
