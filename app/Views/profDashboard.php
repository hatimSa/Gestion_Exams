<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
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
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2.5em;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 1.8em;
            color: #333;
        }

        .card ul {
            list-style-type: none;
            padding-left: 0;
        }

        .card ul li {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            font-size: 1.1em;
            color: #555;
            transition: background-color 0.3s ease;
        }

        .card ul li:hover {
            background-color: #e0e0e0;
        }

        .card ul li a {
            color: #6e7cb2;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .card ul li a:hover {
            color: #4a5b8b;
        }

        .card-header {
            font-size: 1.3em;
            margin-bottom: 15px;
            color: #6e7cb2;
        }

        .card-content {
            padding-left: 15px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #6e7cb2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5a6499;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include('profSidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Professor Dashboard</h1>
        </div>

        <div class="card">
            <h3>Welcome, <?php echo strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']); ?></h3>
            <p>Here you can manage your exams and view student results.</p>
        </div>

        <div class="card">
            <div class="card-header">Manage Exams</div>
            <ul>
                <li><a href="/gestion_Exams/public/examsList">Voir tous les Exams</a></li>
                <li><a href="/gestion_Exams/public/examsAdd">Ajouter un Exam</a></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">Résultats des Etudiants</div>
            <div class="card-content">
                <ul>
                    <!-- Loop through student results dynamically -->
                    <?php foreach ($studentResults as $result): ?>
                        <li>
                            <strong><?php echo $result->student_name; ?></strong> -
                            <?php echo $result->module; ?> -
                            <strong><?php echo $result->note; ?>/20</strong>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>