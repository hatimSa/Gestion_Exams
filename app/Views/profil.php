<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            overflow: auto;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 450px;
            text-align: center;
            margin-top: 30px;
        }

        img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #007bff;
        }

        h2 {
            margin-bottom: 20px;
            color: #007bff;
            font-size: 1.5rem;
        }

        div {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f0f0f0;
            cursor: not-allowed;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: not-allowed;
            opacity: 0.6;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <!-- Inclure le sidebar -->
    <?= view('sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <form>
            <img src="profile.jpg" alt="Profile Picture">
            <h2>Your Profile Information</h2>
            <div>
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?= esc($compte['first_name']) ?>" readonly>
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?= esc($compte['last_name']) ?>" readonly>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= esc($compte['email']) ?>" readonly>
            </div>
            <button type="button" disabled>Save Changes</button>
        </form>
    </div>
</body>

</html>