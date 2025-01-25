<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes des Modules</title>
    <style>
        /* Styles de base */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
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

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }

        /* Table stylée */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
            border-radius: 8px 8px 0 0;
            overflow: hidden;
        }

        .styled-table thead tr {
            background-color: #4CAF50;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #4CAF50;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            .styled-table thead {
                display: none;
            }

            .styled-table tbody tr {
                display: block;
                margin-bottom: 15px;
            }

            .styled-table tbody tr td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 16px;
                padding: 10px 0;
            }

            .styled-table tbody tr td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #4CAF50;
            }
        }
    </style>
</head>

<?= view('etudSidebar'); ?>

<body>
    <div class="container">
        <h1>Notes des Modules</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <!-- Affichage dynamique des notes -->
                <?php if (!empty($notes)): ?>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td data-label="Module"><?= esc($exam['module']); ?></td>
                            <td data-label="Note"><?= esc($note['note']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Aucune note disponible</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>