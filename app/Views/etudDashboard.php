<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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

        .card h3 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include('etudSidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Student Dashboard</h1>
        </div>

        <div class="card">
            <h3>Welcome, <?php echo strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']); ?></h3>
            <p>Here are your upcoming exams and recent results.</p>
        </div>

        <div class="card">
            <h3>Upcoming Exams</h3>
            <ul>
                <!-- Loop through upcoming exams from the database -->
                <?php foreach ($upcomingExams as $exam): ?>
                    <li><?php echo $exam['exam_name']; ?> on <?php echo $exam['exam_date']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="card">
            <h3>Recent Results</h3>
            <ul>
                <!-- Loop through recent results -->
                <?php foreach ($recentResults as $result): ?>
                    <li><?php echo $result['exam_name']; ?> - <?php echo $result['score']; ?>%</li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</body>

</html>