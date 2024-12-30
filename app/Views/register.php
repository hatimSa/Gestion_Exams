<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
<?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('register/store') ?>" method="post">
        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" id="first_name" required>
        <br>

        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" id="last_name" required>
        <br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>

        <label for="phone_number">Numéro de téléphone :</label>
        <input type="text" name="phone_number" id="phone_number" required>
        <br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <br>

        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>