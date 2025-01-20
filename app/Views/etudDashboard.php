<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
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

        #calendar {
            max-width: 100%;
            margin: 20px auto;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        <!-- Calendar Section -->
        <div class="card">
            <h3>Event Schedule</h3>
            <div id="calendar"></div>
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

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    // Loop through the upcoming exams and pass them as events to FullCalendar
                    <?php foreach ($upcomingExams as $exam): ?> {
                            title: '<?php echo addslashes($exam["exam_name"]); ?>',
                            start: '<?php echo date('Y-m-d', strtotime($exam["exam_date"])); ?>',
                        },
                    <?php endforeach; ?>
                ]
            });
            calendar.render();
        });
    </script>
</body>

</html>