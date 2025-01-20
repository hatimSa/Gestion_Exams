<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        /* Style de base */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
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

        /* Contenu principal */
        .main-content {
            margin-left: 250px;
            padding: 40px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Style du formulaire de profil */
        .card {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-header {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .card-body {
            text-align: left;
            width: 100%;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 30px;
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 20px;
            /* Ajout d'un espace supplémentaire après chaque champ */
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        /* Styles pour centrer les boutons */
        .button-container {
            display: flex;
            justify-content: center;
            /* Centre horizontalement */
            align-items: center;
            /* Centre verticalement (si nécessaire) */
            margin-top: 20px;
            /* Ajout d'espace au-dessus des boutons */
        }

        /* Styles pour les boutons */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 10px;
            /* Espacement entre les boutons */
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
        }

        .upload-button {
            display: block;
            padding: 8px 15px;
            font-size: 0.9rem;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            transition: background-color 0.3s ease;
            width: auto;
            max-width: 140px;
            text-align: center;
        }

        .upload-button:hover {
            background-color: #218838;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Inclure le sidebar selon le rôle de l'utilisateur -->
    <?= view('sidebar'); ?>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="card">
            <h3 class="card-header">Profil de <?= strtoupper($compte['first_name']) . ' ' . strtoupper($compte['last_name']) ?></h3>
            <div class="card-body">
                <div class="image-container">
                    <img src="/Gestion_Exams/public/images/profil.jpg" alt="Profil Picture">
                </div>
                <label for="file-upload" class="upload-button">Uploader une photo</label>
                <input type="file" id="file-upload" name="file-upload" accept="image/*">
                <div>
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" value="<?= esc($compte['first_name']) ?>" readonly>
                </div>
                <div>
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" value="<?= esc($compte['last_name']) ?>" readonly>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= esc($compte['email']) ?>" readonly>
                </div>
                <div>
                    <label for="phone_number">Numéro de téléphone</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?= esc($compte['phone_number']) ?>" readonly>
                </div>
                <div>
                    <label for="etat">Status</label>
                    <input type="text" id="etat" name="etat" value="<?= esc($compte['etat']) ?>" readonly>
                </div>
                <div>
                    <label for="role_id">Role</label>
                    <?php
                    // Tableau de correspondance des rôles
                    $roles = [
                        1 => 'etd',
                        2 => 'prof',
                        3 => 'admin',
                    ];

                    // Obtenir le rôle en fonction de role_id ou définir 'Inconnu' par défaut
                    $role = isset($roles[$compte['role_id']]) ? $roles[$compte['role_id']] : 'Inconnu';
                    ?>
                    <input type="text" id="role_id" name="role_id" value="<?= esc($role) ?>" readonly>
                </div>
                <div class="button-container">
                    <a href="<?= site_url('comptes/edit/' . $compte['compte_id']) ?>" class="btn btn-warning">Modifier</a>
                    <a href="<?= site_url('comptes/delete/' . $compte['compte_id']) ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
