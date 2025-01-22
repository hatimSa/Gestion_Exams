<?php

namespace App\Controllers;

use App\Models\NoteModel;

class NotesListController extends BaseController
{
    public function index()
    {
        $noteModel = new NoteModel(); // Assurez-vous que NoteModel est correctement configuré
        $data['notes'] = $noteModel->getNotesWithDetails(); // Chargez les données avec les détails nécessaires

        // Passez les données à la vue
        return view('notesList', $data);
    }

    public function store()
    {
        // Vérifier si des notes ont été soumises via POST
        if ($this->request->getMethod() === 'post') {
            // Récupérer les notes envoyées par le formulaire
            $notes = $this->request->getPost('notes');

            // Instancier le modèle NoteModel
            $noteModel = new NoteModel();

            // Parcourir les notes et les enregistrer dans la base de données
            foreach ($notes as $noteId => $noteValue) {
                // Préparer les données pour la mise à jour
                $data = [
                    'note' => $noteValue
                ];

                // Mettre à jour la note dans la base de données
                $noteModel->update($noteId, $data);
            }

            // Rediriger vers la page des résultats des étudiants ou afficher un message de succès
            return redirect()->to('notesList')->with('success', 'Les notes ont été enregistrées avec succès.');
        }

        // Si la méthode n'est pas POST, rediriger ou afficher un message d'erreur
        return redirect()->to('notesList')->with('error', 'Erreur lors de l\'enregistrement des notes.');
    }

    public function delete($note_id)
    {
        $noteModel = new NoteModel();
        $noteModel->delete($note_id);

        return redirect()->to('/notesList');
    }

    public function update($note_id)
    {
        // Implement the update logic here.
    }

    public function add()
    {
        // Implement the add logic here.
    }
}