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
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
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
            padding: 30px;
            background-color: #fff;
            min-height: 100vh;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2rem;
            color: #4c4c9d;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            font-size: 1rem;
            vertical-align: middle;
        }

        th {
            background-color: #4c4c9d;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions a {
            margin: 0 8px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h1><i class="fas fa-user-circle"></i> Professor</h1>
        <a href="/gestion_Exams/public/profDashboard" class="<?= ($currentPage === 'profDashboard') ? 'active' : '' ?>"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/examsList" class="<?= ($currentPage === 'examsList') ? 'active' : '' ?>"><i class="fas fa-cogs"></i> Gestion des Exams</a>
        <a href="/gestion_Exams/public/notesFinal"><i class="fas fa-list"></i> Resultats des Etudiants</a>
        <a href="/gestion_Exams/public/profReclamations" class="<?= ($currentPage === 'profReclamations') ? 'active' : '' ?>"><i class="fas fa-exclamation-circle"></i> Réclamations</a>
        <a href="/gestion_Exams/public/profil" class="<?= ($currentPage === 'profil') ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Contenu principal -->
    <main>
        <h2>Liste des Exams</h2>

        <a href="/gestion_Exams/public/examsAdd" class="btn">Ajouter un exam</a>
        <table>
            <thead>
                <tr>
                    <th>Département</th>
                    <th>Filière</th>
                    <th>Module</th>
                    <th>Date</th>
                    <th>Heure de début</th>
                    <th>Heure de fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exams as $exam): ?>
                    <tr>
                        <td><?= $exam['departement_name'] ?></td>
                        <td><?= $exam['filiere_name'] ?></td>
                        <td><?= $exam['module'] ?></td>
                        <td><?= $exam['exam_date'] ?></td>
                        <td><?= $exam['start_time'] ?></td>
                        <td><?= $exam['end_time'] ?></td>
                        <td class="actions">
                            <a href="<?= base_url('exams/edit/' . $exam['exam_id']) ?>" class="btn">Modifier</a>
                            <a href="<?= base_url('exams/delete/' . $exam['exam_id']) ?>" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet exam?')">Supprimer</a>
                            <a href="<?= base_url('exams/notesList/' . $exam['exam_id']) ?>" class="btn">Noter</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>