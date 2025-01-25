<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background: linear-gradient(90deg, #6e7cb2, #5b67a1);
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .header h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            font-size: 1.5em;
            margin-bottom: 15px;
            color: #5b67a1;
            border-bottom: 2px solid #ececec;
            padding-bottom: 5px;
        }

        /* Style du calendrier */
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 10px;
            text-align: center;
        }

        .calendar .day-header {
            font-weight: bold;
            background-color: #5b67a1;
            color: white;
            padding: 10px;
            border-radius: 10px;
        }

        .calendar .day {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .calendar .day:hover {
            background-color: #d6dfff;
        }

        .calendar .day-today {
            background-color: #ffecb3;
            font-weight: bold;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        ul li:hover {
            background-color: #eaf2ff;
        }

        .event {
            background-color: #ff6f61;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 0.8em;
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

        <!-- Calendar Section -->
        <div class="card">
            <div class="card-header">Calendrier des événements</div>
            <div class="calendar" id="calendar">
                <!-- Les jours du mois seront générés ici par JavaScript -->
            </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth();
            const currentYear = currentDate.getFullYear();

            // Fonction pour obtenir le premier jour du mois
            function getFirstDayOfMonth(year, month) {
                return new Date(year, month, 1).getDay();
            }

            // Fonction pour obtenir le nombre de jours dans un mois
            function getDaysInMonth(year, month) {
                return new Date(year, month + 1, 0).getDate();
            }

            // Fonction pour générer le calendrier
            function generateCalendar(year, month) {
                const firstDay = getFirstDayOfMonth(year, month);
                const daysInMonth = getDaysInMonth(year, month);
                let calendarHTML = '';

                // En-têtes des jours
                const daysOfWeek = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
                daysOfWeek.forEach(day => {
                    calendarHTML += `<div class="day-header">${day}</div>`;
                });

                // Cellules vides avant le premier jour du mois
                for (let i = 0; i < firstDay; i++) {
                    calendarHTML += `<div class="day"></div>`;
                }

                // Jours du mois
                for (let day = 1; day <= daysInMonth; day++) {
                    const todayClass = (day === currentDate.getDate() && year === currentDate.getFullYear() && month === currentDate.getMonth()) ? 'day-today' : '';
                    calendarHTML += `<div class="day ${todayClass}">${day}</div>`;
                }

                // Insérer le calendrier dans la page
                calendarEl.innerHTML = calendarHTML;
            }

            // Générer le calendrier pour le mois actuel
            generateCalendar(currentYear, currentMonth);
        });
    </script>
</body>

</html>