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
            /* Aligner verticalement */
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
            /* Centrer les éléments à l'intérieur de la carte */
        }

        .card-header {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 58px;
            letter-spacing: 1px;
        }

        .card-body {
            text-align: left;
            width: 100%;
            /* Pour que les inputs prennent toute la largeur de la carte */
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 30px;
            border: 5px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        h1 {
            margin-bottom: 30px;
            color: #007bff;
            font-size: 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        div {
            margin-bottom: 20px;
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

        /* Style du bouton */
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
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            outline: none;
        }

        /* Ajouter un effet d'ombre sur la carte */
        .card:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
</head>

<body>

    <!-- Inclure le sidebar -->
    <?= view('sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="card">
            <h3 class="card-header">Votre Profil</h3>
            <div class="card-body">
                <form>
                    <img src="/Gestion_Exams/public/images/profil.jpg" alt="Profil Picture">
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
                </form>
            </div>
        </div>
    </div>

</body>

</html>