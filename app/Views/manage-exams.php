<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Exams</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #6e7cb2;
            color: #fff;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            color: #fff;
            cursor: pointer;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 3px;
        }

        .btn-edit {
            background-color: #4caf50;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-add {
            background-color: #6e7cb2;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php echo view('profSidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Manage Exams</h1>
        </div>

        <div class="card">
            <a href="/add-exam" class="btn btn-add"><i class="fas fa-plus"></i> Add New Exam</a>

            <table>
                <thead>
                    <tr>
                        <th>Exam ID</th>
                        <th>Module</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Filiere</th>
                        <th>Responsable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Exemple de ligne vide ou statique -->
                    <tr>
                        <td>1</td>
                        <td>Mathematics</td>
                        <td>2025-01-25</td>
                        <td>10:00 AM</td>
                        <td>12:00 PM</td>
                        <td>Science</td>
                        <td>Prof. John Doe</td>
                        <td>
                            <a href="/edit-exam?id=1" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/delete-exam?id=1" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this exam?');"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>No exams found. Click "Add New Exam" to create one.</p>
        </div>
    </div>

</body>

</html>
