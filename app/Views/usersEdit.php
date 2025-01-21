<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Réutiliser les styles de la barre latérale et du contenu principal */
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

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .card {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .card-body {
            padding: 15px;
        }
    </style>
</head>

<body>
    <!-- Inclure la barre latérale -->
    <?= view('sidebar'); ?>

    <div class="main-content">
        <div class="card">
            <h3 class="card-header">Modifier l'utilisateur</h3>
            <div class="card-body">
                <?php if (!empty($compte)): ?>
                    <form action="<?= site_url('comptes/update/' . $compte['compte_id']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="first_name">Prénom</label>
                            <input type="text" name="first_name" id="first_name" value="<?= esc($compte['first_name']) ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Nom</label>
                            <input type="text" name="last_name" id="last_name" value="<?= esc($compte['last_name']) ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?= esc($compte['email']) ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="ohone_number">Numéro de téléphone</label>
                            <input type="text" name="phone_number" id="phone_number" value="<?= esc($compte['phone_number']) ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="etat">Status</label>
                            <select name="etat" id="etat" class="form-control">
                                <option value="accepted" <?= ($compte['etat'] === 'accepted' ? 'selected' : '') ?>>Accepté</option>
                                <option value="pending" <?= ($compte['etat'] === 'pending' ? 'selected' : '') ?>>En attente</option>
                                <option value="rejected" <?= ($compte['etat'] === 'rejected' ? 'selected' : '') ?>>Refusé</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role_type">Rôle</label>
                            <select name="role_type" id="role_type" class="form-control">
                                <option value="etd" <?= ($compte['role_type'] === 'etd' ? 'selected' : '') ?>>Étudiant</option>
                                <option value="prof" <?= ($compte['role_type'] === 'prof' ? 'selected' : '') ?>>Professeur</option>
                                <option value="admin" <?= ($compte['role_type'] === 'admin' ? 'selected' : '') ?>>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <a href="<?= site_url('/usersList') ?>" class="btn btn-secondary">Annuler</a>
                    </form>
                <?php else: ?>
                    <p>Aucune donnée disponible pour cet utilisateur.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Inclure jQuery et Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>