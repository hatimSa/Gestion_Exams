<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <form action="<?= base_url('login') ?>" method="post">
        <div>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <label for="Email">Email</label>
            <input type="text" id="Email" name="Email" placeholder="Email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>