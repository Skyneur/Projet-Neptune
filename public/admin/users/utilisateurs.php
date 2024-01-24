<?php

require_once __DIR__ . '/../../../database.php';
require_once __DIR__ . '/../../../_includes/guard_admin.php';
require_once __DIR__ . '/../../../_includes/admin_navbar.php';

$query = $pdo->query('SELECT * FROM users');

// Variables pour le template
$navbar = new Navbar();
$users = $query->fetchAll();


include __DIR__ . '/../../../_includes/document_start.php';
?>

<div class="bg-body-tertiary pt-5">
    <div class="container bg-body-tertiary">
        <h1 class="">Administration de l'hotel</h1>
    </div>
    <?php echo $navbar->render('utilisateurs'); ?>
</div>

<div class="container my-4">
    <div class="row">
        <div class="col me-auto">
            <h2>Liste des membres</h2>
        </div>
    </div>

    <div class="table-responsive border rounded">
        <table class="table table-hover table-striped mb-0">
            <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Nom</th>
                    <th style="text-align: center;">Prénom</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">Admin</th>
            </tr>

            <?php foreach ($users as $user) { ?>
    <tr>
        <td style="text-align: center;"><?php echo $user['id']; ?></td>
        <td style="text-align: center;">
            <?php echo isset($user['name']) ? $user['name'] : 'N/A'; ?>
        </td>
        <td style="text-align: center;"><?php echo $user['firstname']; ?></td>
        <td style="text-align: center;"><?php echo $user['email']; ?></td>
        <td>
            <div style="text-align: center;">
                <?php if ($user['isAdmin']) { ?>
                    <i class="fa-solid fa-check text-success"></i>
                <?php } ?>
            </div>
        <td style="text-align: center;">
            <a href="/admin/users/utilisateurs_edit.php?id=<?php echo $user['id']; ?>" class="icon-link">
                <i class="fa-duotone fa-pen-to-square"
                   style="--fa-primary-color: #d64980; --fa-secondary-color: #ff8f87; --fa-secondary-opacity: 1;"></i>
            </a>
            <a href="/admin/users/utilisateurs_delete.php?id=<?php echo $user['id']; ?>" class="icon-link text-danger">
                <i class="fa-solid fa-trash-alt"></i>
            </a>
        </td>
    </tr>
<?php } ?>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../../../_includes/document_end.php'; ?>
