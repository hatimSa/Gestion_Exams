<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            position: fixed;
            height: 100%;
            padding-top: 20px;
            z-index: 10;
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

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            color: black;
            text-align: center;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #6e7cb2;
            outline: none;
        }

        .sidebar a.active i {
            color: #fff;
        }

        .input-box {
            margin-bottom: 15px;
        }

        .input-box select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .input-box select:focus {
            border-color: #6e7cb2;
            background-color: #fff;
            outline: none;
        }

        .input-box select option {
            padding: 10px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #8a99d3;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 30px;
        }

        .form-group button:hover {
            background-color: #6e7cb2;
        }
    </style>
</head>

<?= view('sidebar'); ?>

<body>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Ajouter un Nouvel Utilisateur</h1>
        </div>

        <!-- Formulaire d'Ajout d'Utilisateur -->
        <div class="card">
            <h3>Veuillez entrer les informations</h3>
            <?php if (isset($validation)): ?>
                <div class="error">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('usersAdd/store') ?>" method="post">
                <div class="form-group">
                    <label for="first_name">Prénom :</label>
                    <input type="text" name="first_name" id="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Nom :</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required>
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
                        <?php foreach ($filieres as $filiere): ?>
                            <option value="<?= $filiere['filiere_id']; ?>"><?= $filiere['filiere_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="phone_number">Numéro de téléphone :</label>
                    <input type="text" name="phone_number" id="phone_number" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="input-box">
                    <label for="etat">Status :</label>
                    <select name="etat" id="etat" required>
                        <option value="pending">pending</option>
                        <option value="accepted">accepted</option>
                        <option value="rejected">rejected</option>
                    </select>
                </div>

                <div class="input-box">
                    <label for="role">Rôle :</label>
                    <select name="role_id" id="role_id" required>
                        <option value="" disabled selected>-- Sélectionner un rôle --</option>
                        <option value="1">Étudiant</option>
                        <option value="2">Professeur</option>
                        <option value="3">Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>