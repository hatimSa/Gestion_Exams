<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .tile-stats {
            position: relative;
            padding: 20px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #6e7cb2, #4c4c9d);
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tile-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .tile-stats .icon {
            font-size: 50px;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.8);
        }

        .tile-stats .num {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .tile-stats h3 {
            font-size: 18px;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .tile-stats p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Custom colors for each card */
        .tile-blue {
            background: linear-gradient(135deg, #1e90ff, #1c75d1);
        }

        .tile-green {
            background: linear-gradient(135deg, #28a745, #218838);
        }

        .tile-red {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        .tile-aqua {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }

        .tile-yellow {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #fff;
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
            width: 40px;
            background-color: #6e7cb2;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .bar:hover {
            background-color: #4c4c9d;
        }

        .bar-label {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 12px;
            color: #333;
            white-space: nowrap;
        }

        .card-body {
            padding: 20px;
        }

        .tables-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .table-wrapper {
            flex: 1;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .table-wrapper h4 {
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
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

<?= view('sidebar'); ?>

<body>
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

        <div class="row">
            <!-- Card Étudiants -->
            <div class="col-md-4">
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="num"><?= $totalStudents; ?></div>
                    <h3>Étudiants</h3>
                    <p>Total des étudiants inscrits.</p>
                </div>
            </div>

            <!-- Card Professeurs -->
            <div class="col-md-4">
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="num"><?= $totalProfessors; ?></div>
                    <h3>Professeurs</h3>
                    <p>Total des professeurs enregistrés.</p>
                </div>
            </div>

            <!-- Card Utilisateurs -->
            <div class="col-md-4">
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="num"><?= $totalUsers; ?></div>
                    <h3>Utilisateurs</h3>
                    <p>Nombre total d'utilisateurs dans le système.</p>
                </div>
            </div>

            <!-- Card Departements -->
            <div class="col-md-4">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="fas fa-building"></i></div>
                    <div class="num"><?= $totalDepartements; ?></div>
                    <h3>Departements</h3>
                    <p>Total des departements existants.</p>
                </div>
            </div>

            <!-- Card filieres -->
            <div class="col-md-4">
                <div class="tile-stats tile-yellow">
                    <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="num"><?= $totalFilieres; ?></div>
                    <h3>Filieres</h3>
                    <p>Total des filieres existantes.</p>
                </div>
            </div>
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
            <h3>Derniers Enregistrements</h3>
            <div class="tables-container">
                <!-- Table des étudiants -->
                <div class="table-wrapper">
                    <h4>Étudiants</h4>
                    <table id="students-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($students)): ?>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td><?= strtoupper($student['last_name']); ?></td>
                                        <td><?= strtoupper($student['first_name']); ?></td>
                                        <td><?= $student['email']; ?></td>
                                        <td>
                                            <a href="<?= site_url('details/' . $student['compte_id']) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Aucun étudiant trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Table des professeurs -->
                <div class="table-wrapper">
                    <h4>Professeurs</h4>
                    <table id="teachers-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($professors)): ?>
                                <?php foreach ($professors as $professor): ?>
                                    <tr>
                                        <td><?= strtoupper($professor['last_name']); ?></td>
                                        <td><?= strtoupper($professor['first_name']); ?></td>
                                        <td><?= $professor['email']; ?></td>
                                        <td>
                                            <a href="<?= site_url('details/' . $professor['compte_id']) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>