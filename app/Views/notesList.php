<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Ajout de Font Awesome -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #4c4c9d;
            color: #fff;
            padding-top: 20px;
            overflow-y: auto;
        }

        .sidebar h1 {
            padding-left: 22px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #6e7cb2;
        }

        .sidebar a.active {
            background-color: #6e7cb2;
            color: #fff;
            font-weight: bold;
        }

        .sidebar a.active i {
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
        }

        input[type="number"] {
            max-width: 80px;
            text-align: center;
        }

        .abs-input {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h1><i class="fas fa-user-circle"></i> Professor</h1>
        <a href="/gestion_Exams/public/profDashboard"><i class="fas fa-home"></i> Home</a>
        <a href="/gestion_Exams/public/examsList"><i class="fas fa-cogs"></i> Gestion des Exams</a>
        <a href="/gestion_Exams/public/notesFinal"><i class="fas fa-list"></i> Resultats des Etudiants</a>
        <a href="/gestion_Exams/public/profReclamations"><i class="fas fa-exclamation-circle"></i> Réclamations</a>
        <a href="/gestion_Exams/public/profil"><i class="fas fa-user"></i> Profil</a>
        <a href="/gestion_Exams/public/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h2 class="mb-4 text-center">Liste des Notes pour <?= esc($exam['module']); ?></h2>

        <!-- Messages flash -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/notesList/' . $exam['exam_id'] . '/store'); ?>" method="post">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nom Complet</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?= esc($note['first_name']) . ' ' . esc($note['last_name']); ?></td>
                            <td>
                                <!-- Input pour la note -->
                                <input type="number" name="notes[<?= esc($note['note_id']); ?>]" class="form-control" step="0.01" min="0" max="20" value="<?= esc($note['note']) === 'abs' ? '' : esc($note['note']) ?>" placeholder="Saisir une note">
                                <!-- Case à cocher pour marquer l'absence -->
                                <input type="checkbox" name="abs[<?= esc($note['note_id']); ?>]" class="abs-input" value="abs" <?= esc($note['note']) === 'abs' ? 'checked' : '' ?>>
                                <label for="abs[<?= esc($note['note_id']); ?>]">Absent</label>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enregistrer les Notes</button>
            </div>
        </form>
    </div>
    <script>
        // Auto-close alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => alert.classList.add('d-none'));
        }, 5000);
    </script>

</body>

</html>