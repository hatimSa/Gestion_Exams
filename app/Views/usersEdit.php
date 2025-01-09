<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        /* Style for the body */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
}

/* Sidebar style */



/* Main content style */
.main-content {
    margin-left: 250px; /* Space for the sidebar */
    padding: 20px;
    min-height: 100vh; /* Ensure full height */
    margin-top: 20px; /* Optional: Add top margin if needed */
}

/* Center the card */
.card {
    margin: 0 auto; /* Center the card */
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 800px; /* Set a max width for the form */
    width: 100%; /* Ensure it takes full width but not more than max-width */
}

/* Card header */
.card-header {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

/* Form styling */
.form-group {
    margin-bottom: 15px;
}

/* Form input fields */
input.form-control,
select.form-control {
    width: 100%; /* Ensure inputs take full width of the container */
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

/* Styling for buttons */
.btn {
    padding: 6px 12px;
    border-radius: 5px;
    text-align: center;
    font-size: 14px;
    transition: all 0.3s ease;
}

/* Button styling */
.btn-primary {
    background-color: #007bff;
    border: none;
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

            </style>
</head>

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
