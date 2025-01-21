<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link href="https://cdn.datatables.net/2.2.0/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ajout de Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

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
        #comptes-table td {
            background-color: #f9f9f9;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        #comptes-table tr:hover {
            background-color: #eaf3ff;
            transition: background-color 0.3s ease-in-out;
        }

        td:last-child {
            text-align: center;
        }

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

        .alert-success {
            font-size: 16px;
            text-align: center;
            animation: fadeIn 1s ease-out;
            border: 1px solid #28a745;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Style de l'alerte */
        .alert {
            font-size: 16px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-dismissible .close {
            color: white;
            font-size: 18px;
            padding: 0.75rem 1.25rem;
        }

        #success-alert {
            width: 300px; /* Réduit la largeur de l'alerte */
            margin: 0 auto;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body>
    <!-- Affichage de l'alerte de succès si elle existe -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <strong>Succès! </strong> <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
        .card-body {
            padding: 15px;
        }
    </style>
</head>

<body>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?= view('sidebar'); ?>

    <div class="main-content">
        <div class="card">
            <h3 class="card-header">
                Liste des utilisateurs
                <a href="<?= site_url('/usersAdd') ?>" class="btn btn-primary" style="float: right;">Ajouter un utilisateur</a>
            </h3>
            <div class="card-body">
                <table id="comptes-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <td>Département</td>
                            <td>Filière</td>
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
                                <td><?= esc($compte['departement_name']) ?></td>
                                <td><?= esc($compte['filiere_name']) ?></td>
                                <td><?= esc($compte['last_name']) ?></td>
                                <td><?= esc($compte['first_name']) ?></td>
                                <td><?= esc($compte['email']) ?></td>
                                <td><?= esc($compte['role_type']) ?></td>
                                <td><?= esc($compte['etat']) ?></td>
                                <td>
                                    <a href="<?= site_url('details/' . $compte['compte_id']) ?>" class="btn btn-primary btn-sm d-inline-block mx-0">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= site_url('comptes/edit/' . $compte['compte_id']) ?>" class="btn btn-warning btn-sm d-inline-block mx-0">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?= site_url('comptes/delete/' . $compte['compte_id']) ?>" class="btn btn-danger btn-sm d-inline-block mx-0" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
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
                ]
            });

            // Cache le message flash après 5 secondes
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        });
    </script>

</body>

</html>