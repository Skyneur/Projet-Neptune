<?php

require_once __DIR__ . '/../../database.php';
require_once __DIR__ . '/../../_includes/guard_admin.php';
require_once __DIR__ . '/../../_includes/admin_navbar.php';

$query = $pdo->query('SELECT * FROM bedroom');

// Variables pour le template
$navbar = new Navbar();
$chambres = $query->fetchAll();
$expo = ['Nord', 'Est', 'Sud', 'Ouest'];

include __DIR__ . '/../../_includes/document_start.php';
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
            <a href="/admin/chambres_new.php" class="btn btn-primary rounded-pill">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive border rounded">
        <table class="table table-hover table-striped mb-0">
            <tr>
                <th>Id</th>
                <th>Numéro</th>
                <th>Exposition</th>
                <th>SdB</th>
                <th>WC</th>
                <th>Lit double</th>
                <th>Lit simple</th>
                <th>Canapé</th>
                <th>Actions</th>
            </tr>
            <tr>
                <?php foreach($chambres as $chambre) { ?>
                    <td><?php echo $chambre['id']; ?></td>
                    <td><?php echo $chambre['number']; ?></td>
                    <td><?php echo $expo[$chambre['expo']]; ?></td>
                    <td>
                        <?php if ($chambre['bathroom']) { ?>
                            <i class="fa-solid fa-check text-success"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['wc']) { ?>
                            <i class="fa-solid fa-check text-success"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['double_bed']) { ?>
                            <i class="fa-solid fa-check text-success"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['single_bed']) { ?>
                            <i class="fa-solid fa-check text-success"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($chambre['couch']) { ?>
                            <i class="fa-solid fa-check text-success"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <a 
                            href="/admin/chambres_edit.php?id=<?php echo $chambre['id']; ?>" 
                            class="icon-link"
                        >
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <a 
                            href="/admin/chambres_delete.php?id=<?php echo $chambre['id']; ?>" 
                            class="icon-link text-danger"
                        >
                            <i class="fa-solid fa-trash-alt"></i>
                        </a>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../../_includes/document_end.php'; ?>
