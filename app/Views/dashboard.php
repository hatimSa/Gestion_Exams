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

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background-color: #6e7cb2;
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
    <?php include('sidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="card">
            <h3>Welcome,
                <?php
                // Vérifie si l'utilisateur et son compte sont disponibles
                if (isset($compte)) {
                    // Si l'utilisateur est connecté, affiche son prénom et nom
                    echo strtoupper($compte->first_name) . ' ' . strtoupper($compte->last_name);
                } else {
                    // Si l'utilisateur n'est pas connecté, affiche "Guest"
                    echo 'Guest';
                }
                ?>
            </h3>
            <p>This is your application dashboard. Here you can find various stats and quick links to your profile and settings.</p>
        </div>

        <div class="card">
            <h3>Statistics</h3>
            <p>Display some useful statistics here.</p>
        </div>
    </div>

</body>

</html>