<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-4.0.0-dist/css/bootstrap.min.css'); ?>">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Login Page</title>
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
            /* Ajouté pour permettre un alignement vertical */
        }

        .container {
            position: relative;
            width: 850px;
            height: 550px;
            background: rgba(255, 255, 255, 0.8);
            /* Ajout d'une transparence au fond du formulaire */
            border-radius: 30px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
            overflow: hidden;
            z-index: 2;
            margin-bottom: 30px;
            /* Ajouté pour l'espacement sous la carte de login */
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(226, 226, 226, 0.8), rgba(201, 214, 255, 0.8));
            /* Dégradé en arrière-plan */
            z-index: 1;
        }

        .form-box {
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            color: #333;
            text-align: center;
            padding: 40px;
            z-index: 1;
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
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            padding: 13px 50px 13px 20px;
            background: #eee;
            border-radius: 8px;
            border: none;
            outline: none;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .input-box input::placeholder {
            color: #888;
            font-weight: 400;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #888;
        }

        .forgot-link {
            margin: -15px 0 15px;
        }

        .forgot-link a {
            font-size: 14.5px;
            color: #333;
            text-decoration: none;
        }

        .btn {
            width: 100%;
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

        .container p {
            font-size: 14.5px;
            margin: 15px 0;
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
            width: 50%;
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
        <div class="form-box login">
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <h1>Login</h1>
                <div class="input-box">
                    <!-- Message d'erreur général -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="error"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <!-- Message de succès -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <input type="email" placeholder="Email" name="Email" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <div class="forgot-link">
                    <a href="<?= base_url('forgot-password') ?>">Forgot password</a>
                    <button type="submit" class="btn">Login</button>
                    <p>or login with social platforms</p>
                    <div class="social-icons">
                        <a href="#"><i class='bx bxl-google'></i></a>
                        <a href="#"><i class='bx bxl-facebook'></i></a>
                        <a href="#"><i class='bx bxl-github'></i></a>
                        <a href="#"><i class='bx bxl-linkedin'></i></a>
                    </div>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account</p>
                <button class="btn register-btn" onclick="window.location.href='<?= base_url('register') ?>'">Register</button>
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

        // Sélectionne l'élément avec l'id "proverb"
        var proverbElement = document.getElementById("proverb");

        function changeProverb() {
            // Choisis un proverbe aléatoire à afficher
            var randomProverb = proverbs[Math.floor(Math.random() * proverbs.length)];

            // Affiche le proverbe dans l'élément
            proverbElement.textContent = randomProverb;
        }

        // Appelle la fonction pour changer le proverbe toutes les 5000 millisecondes (5 secondes)
        setInterval(changeProverb, 5000);
    </script>

</body>

</html>