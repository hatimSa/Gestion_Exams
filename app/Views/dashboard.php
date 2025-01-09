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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f9;
            color: #333;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        h3 {
            margin-top: 20px;
            color: #333;
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

        <!-- Welcome Section -->
        <div class="card">
            <h3>Welcome,
                <?php
                if (isset($compte)) {
                    echo strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']);
                } else {
                    echo 'Guest';
                }
                ?>
            </h3>
            <p>This is your application dashboard. Here you can find various stats and quick links to your profile and settings.</p>
        </div>

        <!-- Statistics Section -->
        <div class="card">
            <h3>Statistics</h3>
            <p>Display some useful statistics here.</p>
            <div class="chart-container">
                <?php
                $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                $counts = [12, 8, 15, 20, 10, 18, 3];

                for ($i = 0; $i < count($days); $i++): ?>
                    <div class="bar" style="height: <?= $counts[$i] * 10; ?>px;" title="<?= $days[$i] . ': ' . $counts[$i]; ?>">
                        <span class="bar-label"><?= $days[$i]; ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Users Tables Section -->
        <div class="card-body">
            <!-- Table des étudiants -->
            <h3>Étudiants</h3>
            <table id="students-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= strtoupper($student['last_name']); ?></td>
                                <td><?= strtoupper($student['first_name']); ?></td>
                                <td><?= $student['email']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucun étudiant trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Table des professeurs -->
            <h3>Professeurs</h3>
            <table id="teachers-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($teachers)): ?>
                        <?php foreach ($teachers as $teacher): ?>
                            <tr>
                                <td><?= strtoupper($teacher['last_name']); ?></td>
                                <td><?= strtoupper($teacher['first_name']); ?></td>
                                <td><?= $teacher['email']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucun professeur trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>