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

<body>
    <div class="container">
        <h1>Notes des Modules</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Date de l'examen</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemple de données -->
                <tr>
                    <td data-label="Module">Mathématiques</td>
                    <td data-label="Date de l'examen">2025-01-10</td>
                    <td data-label="Note">16.5</td>
                </tr>
                <tr>
                    <td data-label="Module">Informatique</td>
                    <td data-label="Date de l'examen">2025-01-15</td>
                    <td data-label="Note">14.0</td>
                </tr>
                <tr>
                    <td data-label="Module">Physique</td>
                    <td data-label="Date de l'examen">2025-01-20</td>
                    <td data-label="Note">12.5</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>