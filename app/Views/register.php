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
        }

        .container {
            position: relative;
            width: 1000px;
            /* Augmenter la largeur */
            height: 750px;
            /* Augmenter la hauteur */
            background: rgba(255, 255, 255, 0.8);
            border-radius: 30px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
            overflow: hidden;
            z-index: 2;
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
                    <select name="departement_id" id="departement_id" required>
                        <option value="" disabled selected>-- Sélectionner un département --</option>
                        <?php foreach ($departements as $departement): ?>
                            <option value="<?= $departement['departement_id']; ?>"><?= $departement['departement_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-box">
                    <select name="filiere_id" id="filiere_id" required>
                        <option value="" disabled selected>-- Sélectionner une filière --</option>
                        <!-- Les options seront chargées dynamiquement ici -->
                    </select>
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

    <div class="proverb-box">
        <p id="proverb">Loading proverb...</p>
    </div>

    <script>
        // Fonction pour charger dynamiquement les filières en fonction du département sélectionné
        document.getElementById('departement_id').addEventListener('change', function() {
            const departementId = this.value;
            const filiereSelect = document.getElementById('filiere_id');

            if (departementId) {
                // Afficher l'URL pour vérifier qu'elle est correcte
                console.log(`Fetching filieres for departement_id: ${departementId}`);

                fetch(`<?= base_url('getFilieresByDepartement') ?>/${departementId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Vérifier les données dans la console
                        console.log(data);

                        // Réinitialiser les options de filières
                        filiereSelect.innerHTML = '<option value="" disabled selected>-- Sélectionner une filière --</option>';

                        // Ajouter les options de filières récupérées
                        data.forEach(filiere => {
                            const option = document.createElement('option');
                            option.value = filiere.filiere_id;
                            option.textContent = filiere.filiere_name;
                            filiereSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des filières:', error);
                    });
            } else {
                // Réinitialiser les options si aucun département n'est sélectionné
                filiereSelect.innerHTML = '<option value="" disabled selected>-- Sélectionner une filière --</option>';
            }
        });
    </script>
</body>

</html>