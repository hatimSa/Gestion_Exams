<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réclamations</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #4CAF50;
        }

        table {
            width: 90%;
            margin: 20px auto;
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
        }

        /* Style for the "Utilisateur" column */
        td:first-child {
            color: #4CAF50;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            padding: 6px 12px;
            font-size: 12px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            background-color: #4CAF50;
        }

        .actions a.delete {
            background-color: #f44336;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            th,
            td {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <h2>Liste des réclamations</h2>

    <?php if (session()->getFlashdata('success')) : ?>
        <div style="color: green; margin: 10px 20px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div style="color: red; margin: 10px 20px;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <table>
        <tr>
            <th>Utilisateur</th>
            <th>Objet</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($reclamations as $reclamation) : ?>
            <tr>
                <td><?= htmlspecialchars($reclamation['first_name'] . ' ' . $reclamation['last_name']) ?></td>
                <td><?= htmlspecialchars($reclamation['objet']) ?></td>
                <td><?= htmlspecialchars($reclamation['message']) ?></td>
                <td>
                    <div class="actions">
                        <a href="/reclamations/edit/<?= $reclamation['id'] ?>">Modifier</a>
                        <a href="/reclamations/delete/<?= $reclamation['id'] ?>" class="delete"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');">
                            Supprimer
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>
