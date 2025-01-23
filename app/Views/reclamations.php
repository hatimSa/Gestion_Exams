<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réclamations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Style personnalisé */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
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
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #4CAF50;
            margin-top: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            font-size: 16px;
            text-transform: uppercase;
        }

        td {
            background-color: #f9f9f9;
            font-size: 14px;
            color: #555;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        tr:hover td {
            background-color: #e1e1e1;
            cursor: pointer;
        }

        td:first-child {
            font-weight: bold;
            color: #4CAF50;
        }

        .actions a {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {

            th,
            td {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <?= view('sidebar'); ?>

    <div class="main-content">
        <div class="header">
            <h2>Liste des réclamations</h2>
        </div>

        <div class="container">
            <?php if (empty($reclamations)) : ?>
                <p style="text-align: center; color: #555;">Aucune réclamation n'a été soumise pour le moment.</p>
            <?php else : ?>
                <table>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($reclamations as $reclamation) : ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($reclamation['first_name'] ?? 'Inconnu') . ' ' . htmlspecialchars($reclamation['last_name'] ?? '') ?>
                            </td>
                            <td><?= htmlspecialchars($reclamation['titre']) ?></td>
                            <td><?= htmlspecialchars($reclamation['description']) ?></td>
                            <td class="actions">
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#responseModal-<?= $reclamation['reclamation_id'] ?>">
                                    Répondre
                                </button>

                                <a href="#"
                                    class="btn btn-danger"
                                    onclick="deleteWithAlert(<?= $reclamation['reclamation_id'] ?>)">Supprimer</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="responseModal-<?= $reclamation['reclamation_id'] ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Répondre à la réclamation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/reclamations/response/<?= $reclamation['reclamation_id'] ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Statut de la réclamation</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="pasEnCours">Pas en cours</option>
                                                    <option value="modifiee">La note est modifiée</option>
                                                    <option value="meme">La même note</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Envoyer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>
    </div>

    <script>
        function deleteWithAlert(id) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/reclamations/delete/' + id;
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>