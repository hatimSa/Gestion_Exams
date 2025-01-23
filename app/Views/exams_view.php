<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f8;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            background-color: #5a67d8;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em;
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

        .exams-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .exam-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .exam-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .exam-item p {
            margin: 10px 0;
            font-size: 1.1em;
        }

        .exam-item p strong {
            color: #5a67d8;
        }

        .exam-item .exam-details {
            display: flex;
            justify-content: space-between;
        }

        .exam-item .exam-details p {
            font-size: 1em;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .sidebar {
                width: 100%;
                position: relative;
                border-radius: 0;
            }

            .header h1 {
                font-size: 2em;
            }

            .exam-item {
                padding: 15px;
            }

            .exam-item .exam-details {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include('etudSidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Welcome to Your Dashboard</h1>
        </div>

        <!-- Affichage des examens -->
        <div class="exams-list">
            <?php if (empty($exams)): ?>
                <p>Aucun examen trouvé.</p>
            <?php else: ?>
                <?php foreach ($exams as $exam): ?>
                    <div class="exam-item">
                        <p><strong>Département:</strong> <?= $exam->departement_name ?></p>
                        <p><strong>Filière:</strong> <?= $exam->filiere_name ?></p>
                        <p><strong>Module:</strong> <?= $exam->module ?></p>
                        <div class="exam-details">
                            <p><strong>Date de l'examen:</strong>
                                <?= ($exam->exam_date === '0000-00-00') ? 'Date non définie' : $exam->exam_date ?>
                            </p>
                            <p><strong>Heure de début:</strong> <?= $exam->start_time ?></p>
                            <p><strong>Heure de fin:</strong> <?= $exam->end_time ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>