<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            width: 250px;
            background-color: #4c4c9d;
            color: #fff;
            position: fixed;
            height: 100%;
            padding-top: 20px;
        }

        .sidebar h1 {
            padding-left: 22px;
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
    </style>
</head>

<body>

    <!-- Sidebar pour le professeur -->
    <div class="sidebar">
        <h1><i class="fas fa-user-circle"></i> Professor</h1>
        <a href="/gestion_Exams/public/profDashboard" class="<?= ($currentPage === 'profDashboard') ? 'active' : '' ?>"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/examsList"><i class="fas fa-cogs"></i> Gestion des Exams</a>
        <a href="/gestion_Exams/public/notesFinal" class="<?= ($currentPage === 'notesFinal') ? 'active' : '' ?>"><i class="fas fa-list"></i>Resultats des Etudiants</a>
        <a href="/gestion_Exams/public/reclamations" class="<?= ($currentPage === 'reclamations') ? 'active' : '' ?>"><i class="fas fa-exclamation-circle"></i>Réclamations</a>
        <a href="/gestion_Exams/public/profil" class="<?= ($currentPage === 'profil') ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

</body>

</html>