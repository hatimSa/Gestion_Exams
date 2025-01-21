<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Exams</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #4c4c9d;
            color: #fff;
            padding-top: 20px;
            overflow-y: auto;
            /* Permet le défilement si nécessaire */
        }

        .sidebar h1 {
            padding-left: 22px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #6e7cb2;
        }

        .sidebar a.active {
            background-color: #6e7cb2;
            color: #fff;
            font-weight: bold;
        }

        .sidebar a.active i {
            color: #fff;
        }

        main {
            margin-left: 250px;
            /* Décale le contenu principal pour ne pas être sous le sidebar */
            padding: 20px;
            background-color: #f9f9f9;
            min-height: 100vh;
            /* Assure que le contenu occupe toute la hauteur de la fenêtre */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h1><i class="fas fa-user-circle"></i> Professor</h1>
        <a href="/gestion_Exams/public/profDashboard" class="<?= ($currentPage === 'profDashboard') ? 'active' : '' ?>"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/examsList" class="<?= ($currentPage === 'examsList') ? 'active' : '' ?>"><i class="fas fa-cogs"></i> Gestion des Exams</a>
        <a href="/student-results"><i class="fas fa-list"></i> Resultats des Etudiants</a>
        <a href="/gestion_Exams/public/profReclamations" class="<?= ($currentPage === 'profReclamations') ? 'active' : '' ?>"><i class="fas fa-exclamation-circle"></i> Mes Réclamations</a>
        <a href="/gestion_Exams/public/profil" class="<?= ($currentPage === 'profil') ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Contenu principal -->
    <main>
        <h2>Liste des exams</h2>

        <a href="/gestion_Exams/public/examsAdd" class="btn">Ajouter un exam</a>
        <table>
            <tr>
                <th>Département</th>
                <th>Filière</th>
                <th>Module</th>
                <th>Date</th>
                <th>heure de début</th>
                <th>heure de fin</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($exams as $exam): ?>
                <tr>
                    <td><?= $exam['departement_name'] ?></td>
                    <td><?= $exam['filiere_name'] ?></td>
                    <td><?= $exam['module'] ?></td>
                    <td><?= $exam['exam_date'] ?></td>
                    <td><?= $exam['start_time'] ?></td>
                    <td><?= $exam['end_time'] ?></td>
                    <td>
                        <a href="<?= base_url('exams/edit/' . $exam['exam_id']) ?>" class="btn">Modifier</a>
                        <a href="<?= base_url('exams/delete/' . $exam['exam_id']) ?>" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet exam?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>

</html>