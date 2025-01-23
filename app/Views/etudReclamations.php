<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réclamations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .header {
            background-color: #6e7cb2;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .card-container {
            padding: 20px;
        }
        .card {
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        tr:hover {
            background-color: #eaf3ff;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .form-container {
            display: none; /* Form is hidden initially */
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }

        /* Style for confirmation modal */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .confirmation-box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            width: 300px;
        }
        .confirmation-box button {
            margin: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .confirmation-box button.cancel {
            background-color: #f44336;
        }
        .confirmation-box button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include('etudSidebar.php'); ?>

<div class="main-content">
    <div class="header">
        <h1>Mes Réclamations</h1>
    </div>
    
    <div class="card-container">
        <a href="#" class="btn" id="showFormBtn">Ajouter une Réclamation</a>
    </div>

    <!-- Formulaire pour ajouter ou modifier une réclamation -->
    <div class="form-container" id="addReclamationForm">
        <h2 id="formTitle">Ajouter une Réclamation</h2>
        <form action="/gestion_Exams/public/etudReclamations/store" method="POST" id="reclamationForm">
            <?= csrf_field() ?>
            <input type="hidden" id="reclamation_id" name="reclamation_id" value="">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" placeholder="Entrez le titre" required>
            
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" placeholder="Entrez la description" required></textarea>
            
            <button type="submit" id="submitBtn">Envoyer</button>
        </form>
    </div>
  
    <div class="card">
        <table>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($reclamations)): ?>
                <?php foreach ($reclamations as $reclamation): ?>
                    <tr>
                        <td><?= esc($reclamation['titre']) ?></td>
                        <td><?= esc($reclamation['description']) ?></td>
                        <td>
                            <!-- Bouton pour afficher la confirmation avant suppression -->
                            <button class="btn" onclick="confirmDelete(<?= esc($reclamation['reclamation_id']) ?>)">Supprimer</button>
                            <!-- Bouton pour modifier, qui va mettre à jour le formulaire -->
                            <button class="btn" onclick="editReclamation(<?= esc($reclamation['reclamation_id']) ?>, '<?= esc($reclamation['titre']) ?>', '<?= esc($reclamation['description']) ?>')">Modifier</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Aucune réclamation trouvée.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</div>    

<!-- Confirmation Modal -->
<div class="confirmation-modal" id="confirmationModal">
    <div class="confirmation-box">
        <p>Êtes-vous sûr de vouloir supprimer cette réclamation ?</p>
        <button id="confirmBtn">Confirmer</button>
        <button class="cancel" id="cancelBtn">Annuler</button>
    </div>
</div>

<script>
    // Afficher/masquer le formulaire d'ajout/modification
    document.getElementById('showFormBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche la redirection
        const form = document.getElementById('addReclamationForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        document.getElementById('formTitle').textContent = 'Ajouter une Réclamation';
        document.getElementById('submitBtn').textContent = 'Envoyer';
    });

    // Fonction pour pré-remplir le formulaire de modification
    function editReclamation(id, titre, description) {
        document.getElementById('reclamation_id').value = id;
        document.getElementById('titre').value = titre;
        document.getElementById('description').value = description;

        document.getElementById('formTitle').textContent = 'Modifier la Réclamation';
        document.getElementById('submitBtn').textContent = 'Mettre à jour';

        const form = document.getElementById('addReclamationForm');
        form.style.display = 'block';
    }

    // Afficher la fenêtre de confirmation de suppression
    function confirmDelete(reclamationId) {
        document.getElementById('confirmationModal').style.display = 'flex';
        
        document.getElementById('confirmBtn').onclick = function() {
            // Soumettre le formulaire de suppression après confirmation
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/gestion_Exams/public/etudReclamations/delete';
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'reclamation_id';
            hiddenField.value = reclamationId;
            form.appendChild(hiddenField);
            document.body.appendChild(form);
            form.submit();
        };

        document.getElementById('cancelBtn').onclick = function() {
            document.getElementById('confirmationModal').style.display = 'none';
        };
    }
</script>
</body>
</html>
