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
            <h3>Welcome, <?php echo strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']); ?></h3>
            <p>Here you can manage your exams and view student results.</p>
        </div>

        <div class="card">
            <h3>Manage Exams</h3>
            <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                <a href="<?php echo site_url('manage-exams'); ?>" class="btn-classic">View All Exams</a>
                <a href="<?php echo site_url('manage-exams'); ?>" class="btn-classic">Add New Exam</a>
            </div>
        </div>

        <style>
            .btn-classic {
                background-color: #6e7cb2;
                color: white;
                padding: 8px 16px;
                border: 1px solid #6e7cb2;
                border-radius: 4px;
                cursor: pointer;
                margin: 4px;
                text-decoration: none;
                font-size: 14px;
            }
            
            .btn-classic:hover {
                background-color: white;
                color: #007bff;
            }
        </style>

        <div class="card" style="background-color:rgb(255, 255, 255); padding: 15px; margin-bottom: 20px; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);">
            <h3 style="margin-bottom: 8px;">Student Results</h3>
            <table style="width: 100%; border-collapse: collapse; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);">
                <thead>
                    <tr style="background-color: #6e7cb2; color: #fff;">
                        <th style="text-align: left; padding: 10px;">Student Name</th>
                        <th style="text-align: left; padding: 10px;">Exam Name</th>
                        <th style="text-align: left; padding: 10px;">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($studentResults as $result): ?>
                        <tr style="background-color: #f9f9f9; transition: background-color 0.3s;">
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $result['student_name']; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $result['exam_name']; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $result['score']; ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card">
            <h3>Statistique</h3>
            <canvas id="myChart" style="width: 100%;"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode(array_column($studentResults, 'student_name')); ?>,
                            datasets: [{
                                label: "Score",
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                data: <?php echo json_encode(array_column($studentResults, 'score')); ?>,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>

</body>

</html>