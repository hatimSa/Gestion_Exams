<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Examen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style de base */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
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

        /* Main content */
        .main-content {
            margin-left: 250px;
            /* Décale le contenu après la sidebar */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            max-width: 800px;
            margin: 50px auto;
        }

        h2 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="time"],
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .form-group button:focus {
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #4CAF50;
        }

        /* Alignement des boutons */
        .form-group .buttons-container {
            display: flex;
            justify-content: space-between;
        }

        .form-group .buttons-container button,
        .form-group .buttons-container .btn-secondary {
            width: 48%;
            /* Largeur égale pour les deux boutons */
        }

        /* Style pour le bouton "Annuler" */
        .form-group .btn-secondary {
            background-color: #ccc;
            color: #333;
            text-align: center;
            text-decoration: none;
            padding: 12px;
            border-radius: 5px;
            display: inline-block;
        }

        .form-group .btn-secondary:hover {
            background-color: #aaa;
        }

        /* Responsive pour petits écrans */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 0;
            }
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
        <a href="/gestion_Exams/public/reclamations" class="<?= ($currentPage === 'reclamations') ? 'active' : '' ?>"><i class="fas fa-exclamation-circle"></i>Réclamations</a>
        <a href="/gestion_Exams/public/profil" class="<?= ($currentPage === 'profil') ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <h2>Modifier Examen</h2>
        <form action="<?= base_url('exams/update/' . $exam['exam_id']) ?>" method="post">
            <div class="form-group">
                <label for="module">Module</label>
                <input type="text" id="module" name="module" value="<?= $exam['module'] ?>" required>
            </div>
            <div class="form-group">
                <label for="exam_date">Date</label>
                <input type="date" id="exam_date" name="exam_date" value="<?= $exam['exam_date'] ?>" required>
            </div>
            <div class="form-group">
                <label for="start_time">Heure de début</label>
                <input type="time" id="start_time" name="start_time" value="<?= $exam['start_time'] ?>" required>
            </div>
            <div class="form-group">
                <label for="end_time">Heure de fin</label>
                <input type="time" id="end_time" name="end_time" value="<?= $exam['end_time'] ?>" required>
            </div>
            <div class="form-group">
                <label for="filiere_id">Filière</label>
                <select id="filiere_id" name="filiere_id" required>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?= $filiere['filiere_id'] ?>" <?= $filiere['filiere_id'] == $exam['filiere_id'] ? 'selected' : '' ?>><?= $filiere['filiere_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group buttons-container">
                <button type="submit">Mettre à jour</button>
                <a href="<?= site_url('/examsList') ?>" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

</body>

</html>