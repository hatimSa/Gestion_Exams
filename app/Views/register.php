<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <title>Register Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'sans-serif';
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('<?= base_url('images/Prof.jpg'); ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            flex-direction: column;
            /* Pour empiler le formulaire et les proverbes */
        }

        .container {
            position: relative;
            width: 850px;
            height: 650px;
            /* Augmenter la hauteur pour inclure les proverbes */
            background: rgba(255, 255, 255, 0.8);
            border-radius: 30px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
            overflow: hidden;
            z-index: 2;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(226, 226, 226, 0.8), rgba(201, 214, 255, 0.8));
            z-index: 1;
        }

        .form-box {
            position: absolute;
            right: 0;
            width: 55%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            color: #333;
            text-align: center;
            padding: 40px;
            z-index: 1;
            flex-direction: column;
            justify-content: center;
        }

        form {
            width: 100%;
        }

        .container h1 {
            font-size: 36px;
            margin: -10px 0;
        }

        .input-box {
            position: relative;
            margin: 20px 0;
        }

        .input-box input,
        .input-box select {
            width: 90%;
            padding: 13px 50px 13px 20px;
            background: #eee;
            border-radius: 8px;
            border: none;
            outline: none;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .input-box input::placeholder,
        .input-box select:focus {
            color: #888;
            font-weight: 400;
        }

        .input-box i {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #888;
        }

        .btn {
            width: 90%;
            height: 48px;
            background: #7494ec;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
        }

        .forgot-link {
            margin: -15px 0 15px;
        }

        .forgot-link a {
            font-size: 14.5px;
            color: #333;
            text-decoration: none;
        }

        .social-icons a {
            display: inline-flex;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 24px;
            color: #333;
            text-decoration: none;
            margin: 0 8px;
        }

        .toggle-box {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .toggle-box::before {
            content: '';
            position: absolute;
            left: -250%;
            width: 300%;
            height: 100%;
            background: #7494ec;
            border-radius: 150px;
            z-index: 2;
        }

        .toggle-panel {
            position: absolute;
            width: 45%;
            height: 100%;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2;
        }

        .toggle-panel p {
            margin-bottom: 20px;
        }

        .toggle-panel .btn {
            width: 160px;
            height: 46px;
            background: transparent;
            border: 2px solid #fff;
            box-shadow: none;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        /* Proverbes */
        .proverb-box {
            margin-top: 30px;
            text-align: center;
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-box register">
            <?php if (isset($validation)): ?>
                <div class="error">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('register/store') ?>" method="post">
                <?= csrf_field() ?>
                <h1>Register</h1>
                <div class="input-box">
                    <!-- Message d'erreur général -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="error"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <!-- Message de succès -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <input type="text" placeholder="First Name" name="first_name" id="first_name" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Last Name" name="last_name" id="last_name" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="email" id="email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Phone Number" name="phone_number" id="phone_number" required>
                    <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <div class="input-box">
                    <select name="role_id" id="role_id" required>
                        <option value="" disabled selected>-- Sélectionner un rôle --</option>
                        <option value="1">Étudiant</option>
                        <option value="2">Professeur</option>
                    </select>
                    <i class='bx bxs-user'></i>
                </div>
                <button type="submit" class="btn">Register</button>
                <p>or register with social platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Already have an account?</p>
                <button class="btn register-btn" onclick="window.location.href='<?= base_url('login') ?>'">Login here</button>
            </div>
        </div>
    </div>

    <!-- Section des proverbes, en dehors de la .container -->
    <div class="proverb-box">
        <p id="proverb">Loading proverb...</p>
    </div>

    <script>
        // Tableau de proverbes
        var proverbs = [
            "La patience est la clé du paradis.",
            "Celui qui sait attendre obtient toujours ce qu'il souhaite.",
            "Le succès ne se mesure pas à la destination finale, mais au chemin parcouru.",
            "Le chemin de mille kilomètres commence par un pas.",
            "La sagesse, c'est de savoir qu'on ne sait rien.",
            "Chaque nuage a une doublure d'argent.",
            "Qui sème le vent récolte la tempête.",
            "Mieux vaut tard que jamais.",
        ];

        // Fonction pour changer le proverbe toutes les 5 secondes
        function changeProverb() {
            var randomIndex = Math.floor(Math.random() * proverbs.length);
            document.getElementById("proverb").textContent = proverbs[randomIndex];
        }

        // Changer le proverbe toutes les 5 secondes
        setInterval(changeProverb, 5000);
        changeProverb(); // Initialiser le proverbe au chargement
    </script>
</body>

</html>