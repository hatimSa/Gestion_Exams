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
.chart-container {
    display: flex;
    align-items: flex-end;
    justify-content: space-around;
    margin-top: 20px;
    padding: 10px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.bar {
    width: 30px;
    background-color: #6e7cb2;
    position: relative;
    transition: background-color 0.3s ease;
}

.bar:hover {
    background-color: #4c4c9d;
}

.bar-label {
    position: absolute;
    
    top: -20px;
    width: 100%;
    text-align: center;
    font-size: 12px;
    color: #333;
}

.card-body {
    padding: 20px;
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
                    echo strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']);
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
            <div class="chart-container">
                <?php 
                // Fetch the data from the database (assumes you have $months and $counts arrays)
                // Example data, replace with actual dynamic data from your database query
                $months = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun'];
                $counts = [12, 8, 15, 20, 10, 18];

                for ($i = 0; $i < count($months); $i++): ?>
                    <div class="bar" style="height: <?php echo $counts[$i] * 10; ?>px;" title="<?php echo $months[$i] . ': ' . $counts[$i]; ?>">
                        <span class="bar-label"><?php echo $months[$i]; ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    
        </div>
        </div>
    </div>
</body>

</html>