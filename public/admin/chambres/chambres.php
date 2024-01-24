<?php
require_once __DIR__ . '/../../../database.php';
require_once __DIR__ . '/../../../_includes/guard_admin.php';
require_once __DIR__ . '/../../../_includes/admin_navbar.php';

// Colonne et ordre de tri par défaut
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

$query = $pdo->prepare("SELECT * FROM bedroom ORDER BY $sortColumn $sortOrder");
$query->execute();

// Variables pour le template
$navbar = new Navbar();
$chambres = $query->fetchAll();
$expo = ['Nord', 'Est', 'Sud', 'Ouest'];

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
            <thead>
            <tr>
                <th style="text-align: center;">
                    <a href="?sort=id&order=<?php echo ($sortColumn == 'id' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'id' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        ID
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=number&order=<?php echo ($sortColumn == 'number' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'number' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        Numéro
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=expo&order=<?php echo ($sortColumn == 'expo' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'expo' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        Exposition
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=bathroom&order=<?php echo ($sortColumn == 'bathroom' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'bathroom' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        Salle De Bain
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=wc&order=<?php echo ($sortColumn == 'wc' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'wc' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        WC
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=single_bed&order=<?php echo ($sortColumn == 'single_bed' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'single_bed' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        Lit simple
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=double_bed&order=<?php echo ($sortColumn == 'double_bed' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'double_bed' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        Lit double
                    </a>
                </th>
                <th style="text-align: center;">
                    <a href="?sort=couch&order=<?php echo ($sortColumn == 'couch' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>"
                       data-order="<?php echo ($sortColumn == 'couch' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">
                        Canapé
                    </a>
                </th>
                <th style="text-align: center;">Actions
                </th>
            </tr>
            </thead>
            <tbody>
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
                            <?php if ($chambre['single_bed']) { ?>
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
                            <?php if ($chambre['couch']) { ?>
                                <div style="text-align: center;">
                                    <i class="fa-solid fa-check text-success"></i>
                                </div>
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
            </tbody>
        </table>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        console.log("Script exécuté !");

        $('th a').on('click', function() {
            console.log("Tri enclenché !");
            var column = $(this).parent().index();
            var sortOrder = $(this).attr('data-order');

            // Ajoutez la classe "sorted-asc" ou "sorted-desc" à la colonne triée
            $('th a').removeClass('sorted-asc sorted-desc');

            $(this).addClass('sorted-' + sortOrder);

            sortTable(column, sortOrder);

            // Inversez l'ordre de tri pour le prochain clic
            $(this).attr('data-order', sortOrder == 'asc' ? 'desc' : 'asc');
        });

        function sortTable(column, sortOrder) {
            console.log("Tri de la table. Colonne:", column, "Ordre de tri:", sortOrder);

            var rows = $('table tbody tr').get();

            rows.sort(function(a, b) {
                var A = $(a).children().eq(column).text().toUpperCase();
                var B = $(b).children().eq(column).text().toUpperCase();

                if (A < B) {
                    return sortOrder === 'asc' ? -1 : 1;
                }

                if (A > B) {
                    return sortOrder === 'asc' ? 1 : -1;
                }

                return 0;
            });

            // Videz le corps du tableau
            $('table tbody').empty();

            $.each(rows, function(index, row) {
                // Ajoutez chaque ligne triée au tableau
                $('table tbody').append(row);
            });
        }

    });
</script>

<?php include __DIR__ . '/../../../_includes/document_end.php'; ?>
