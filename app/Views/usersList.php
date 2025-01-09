<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<style>
    /* Style de base */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .sidebar {
        width: 250px;
        background-color: #333;
        color: #fff;
        position: fixed;
        height: 100%;
        padding-top: 20px;
        z-index: 10;
        /* Assurer que la sidebar est au-dessus du contenu principal */
    }

    .sidebar a {
        display: block;
        color: #fff;
        padding: 15px;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #575757;
    }

    /* Contenu principal */
    .main-content {
        margin-left: 250px;
        /* Espace laissé pour la sidebar */
        padding: 20px;
        min-height: 100vh;
        /* Pour que le contenu occupe toute la hauteur de la page */
    }

    /* Style du tableau */
    #comptes-table {
        width: 100%;
        border-collapse: collapse;
    }

    #comptes-table th,
    #comptes-table td {
        padding: 12px;
        text-align: left;
    }

    #comptes-table th {
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
    }

    #comptes-table td {
        background-color: #f9f9f9;
        font-size: 14px;
        color: #333;
        border-bottom: 1px solid #ddd;
    }

    #comptes-table tr:hover {
        background-color: #f1f1f1;
    }

    /* Style des boutons d'action */
    .btn {
        padding: 6px 12px;
        border-radius: 5px;
        text-align: center;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Pagination */
    .dataTables_paginate {
        margin-top: 20px;
        text-align: center;
    }

    .dataTables_paginate .paginate_button {
        padding: 8px 12px;
        border-radius: 4px;
        margin: 0 3px;
        cursor: pointer;
        background-color: #e9ecef;
        color: #333;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: #007bff;
        color: white;
    }

    .dataTables_paginate .paginate_button.current {
        background-color: #007bff;
        color: white;
    }

    .dataTables_paginate .paginate_button.current:hover {
        background-color: #0056b3;
    }

    /* Info de pagination */
    .dataTables_info {
        font-size: 14px;
        color: #555;
    }

    /* Style de la carte */
    .card {
        margin-top: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card-header {
        font-size: 20px;
        font-weight: bold;
        color: #333;
    }

    .card-body {
        padding: 15px;
    }
</style>

<?= view('sidebar'); ?>
<link href="https://cdn.datatables.net/2.2.0/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<div class="main-content">
    <div class="card">
        <h3 class="card-header">
            Liste des utilisateurs
            <!-- Add User Button -->
            <a href="<?= site_url('/usersAdd') ?>" class="btn btn-primary" style="float: right;">Ajouter un utilisateur</a>
        </h3>
        <div class="card-body">
            <table id="comptes-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comptes as $compte) : ?>
                        <tr>
                            <td><?= esc($compte['last_name']) ?></td>
                            <td><?= esc($compte['first_name']) ?></td>
                            <td><?= esc($compte['email']) ?></td>
                            <td><?= esc($compte['role_type']) ?></td>
                            <td><?= esc($compte['etat']) ?></td>
                            <td>
                                <a href="<?= site_url('profile/' . $compte['compte_id']) ?>" class="btn btn-primary btn-sm">Voir</a>
                                <a href="<?= site_url('comptes/edit/' . $compte['compte_id']) ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="<?= site_url('comptes/delete/' . $compte['compte_id']) ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.0/js/dataTables.bootstrap5.js"></script>

<script>
    $(document).ready(function() {
        $('#comptes-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
            },
            "pagingType": "full_numbers",
            "order": [
                [0, "asc"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 5
            }]
        });
    });
</script>