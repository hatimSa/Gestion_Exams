<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        .sidebar h2 {
            padding-left: 28px;
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

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2><i class="fas fa-user-circle"></i> Admin</h2>
        <a href="/gestion_Exams/public/dashboard" class="<?= ($currentPage === 'dashboard') ? 'active' : '' ?>"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/usersAdd" class="<?= ($currentPage === 'usersAdd') ? 'active' : '' ?>"><i class="fas fa-user-plus"></i> Ajouter</a>
        <a href="/gestion_Exams/public/usersList" class="<?= ($currentPage === 'usersList') ? 'active' : '' ?>"><i class="fas fa-list"></i> Utlisateurs</a>
        <a href="/gestion_Exams/public/profil" class="<?= ($currentPage === 'profil') ? 'active' : '' ?>"><i class="fas fa-user"></i> Profil</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</body>

</html>