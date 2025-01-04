<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
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
    <?php include('profSidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Professor Dashboard</h1>
        </div>

        <div class="card">
            <h3>Welcome, <?php echo strtoupper($compte->first_name) . ' ' . strtoupper($compte->last_name); ?></h3>
            <p>Here you can manage your exams and view student results.</p>
        </div>

        <div class="card">
            <h3>Manage Exams</h3>
            <ul>
                <li><a href="/manage-exams">View All Exams</a></li>
                <li><a href="/add-exam">Add New Exam</a></li>
            </ul>
        </div>

        <div class="card">
            <h3>Student Results</h3>
            <ul>
                <!-- Loop through student results -->
                <?php foreach ($studentResults as $result): ?>
                    <li><?php echo $result['student_name']; ?> - <?php echo $result['exam_name']; ?> - <?php echo $result['score']; ?>%</li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</body>

</html>