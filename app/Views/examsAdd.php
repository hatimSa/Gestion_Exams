<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Nouvel Exam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
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

        .main-content {
            margin-left: 250px;
            /* Décale le contenu principal pour ne pas être sous le sidebar */
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .input-box select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            cursor: pointer;
            box-sizing: border-box;
        }

        .input-box select:focus {
            border-color: #4CAF50;
            outline: none;
            background-color: #fff;
        }

        .input-box option {
            padding: 10px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
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
    <div class="main-content">
        <div class="header">
            <h1>Ajouter un Nouvel Exam</h1>
        </div>

        <form action="<?= base_url('examsAdd/store') ?>" method="post">

            <div class="input-box">
                <select name="filiere_id" id="filiere_id" required>
                    <option value="" disabled selected>-- Sélectionner une filière --</option>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?= $filiere['filiere_id']; ?>"><?= $filiere['filiere_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="module">Module de l'exam:</label>
                <input type="text" id="module" name="module" required>
            </div>

            <div class="form-group">
                <label for="exam_date">Date de l'Exam:</label>
                <input type="date" id="exam_date" name="exam_date" required>
            </div>

            <div class="form-group">
                <label for="start_time">heure de début</label>
                <input type="time" id="start_time" name="start_time" required>
            </div>

            <div class="form-group">
                <label for="end_time">heure de fin</label>
                <input type="time" id="end_time" name="end_time" required>
            </div>

            <button type="submit" class="btn">Ajouter l'Exam</button>
        </form>
    </div>
</body>

</html>