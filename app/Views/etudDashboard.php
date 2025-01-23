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
        }

        .card ul li:nth-child(odd) {
            background-color: #e9e9e9;
        }

        #calendar {
            max-width: 100%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
    <?php include('etudSidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Student Dashboard</h1>
        </div>

        <div class="card">
            <h3>Welcome,
                    <?php
                    if (isset($compte['first_name']) && isset($compte['last_name'])) {
                        echo strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']);
                    } else {
                        echo "User";  // Affiche "User" si les informations sont manquantes
                    }
                    ?>
            </h3>
            <p>Here are your upcoming exams and recent results.</p>
        </div>

        <!-- Calendar Section -->
        <div class="card">
            <div class="card-header">Evenements</div>
            <div id="calendar"></div>
        </div>

        <!-- Upcoming Exams Section -->
        <div class="card">
            <div class="card-header">Les Prochains Exams</div>
            <div class="card-content">
                <ul>
                    <!-- Loop through upcoming exams from the database -->
                    <?php foreach ($upcomingExams as $exam): ?>
                        <li>
                            <?php echo isset($exam['module']) ? $exam['module'] : 'Module not available'; ?> le <?php echo isset($exam['exam_date']) ? $exam['exam_date'] : 'Date not available'; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Recent Results Section -->
        <div class="card">
            <div class="card-header">Mes Résultats Récents</div>
            <div class="card-content">
                <ul>
                    <!-- Loop through recent results -->
                    <?php foreach ($recentResults as $result): ?>
                        <li><?php echo $result->module; ?> - <?php echo $result->note; ?>/20</li>
                    <?php endforeach; ?>
                </ul>
            </div>
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
                            title: '<?php echo addslashes($exam["module"]); ?>',
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