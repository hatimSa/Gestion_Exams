<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            position: fixed;
            height: 100%;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #575757;
        }
    </style>

<body>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="/gestion_Exams/public/dashboard"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/profile"><i class="fas fa-user"></i> Profile</a>
        <a href="/gestion_Exams/public/usersList"><i class="fas fa-list"></i> Users List</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</body>

</html>