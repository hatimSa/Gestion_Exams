<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            background-color: #333;
            color: #fff;
            position: fixed;
            height: 100%;
            padding-top: 20px;
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

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="/gestion_Exams/public/dashboard"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/profil"><i class="fas fa-user"></i> Profile</a>
        <a href="/gestion_Exams/public/usersList"><i class="fas fa-list"></i> Users List</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Application Dashboard</h1>
        </div>

        <div class="card">
            <h3>Welcome, <?= isset($compte) ? $compte['first_name'] . ' ' . $compte['last_name'] : 'Guest' ?></h3>
            <p>This is your application dashboard. Here you can find various stats and quick links to your profile and settings.</p>
        </div>

        <div class="card">
            <h3>Statistics</h3>
            <p>Display some useful statistics here.</p>
        </div>
    </div>

</body>

</html>