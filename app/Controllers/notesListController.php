<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\CompteModel;
use App\Models\ExamModel;

class NotesListController extends BaseController
{
    public function index()
    {
        $noteModel = new NoteModel();
        $data['notes'] = $noteModel->getNotesWithDetails(); // Chargez les données avec les détails nécessaires

        return view('notesList', $data);
    }

    public function store($exam_id)
    {
        // Charger le modèle des notes
        $noteModel = new NoteModel();

        // Récupérer les données soumises depuis le formulaire
        $notes = $this->request->getPost('notes');
        $absences = $this->request->getPost('abs');

        // Parcourir les notes pour chaque étudiant
        foreach ($notes as $note_id => $note_value) {
            // Préparer les données à insérer
            $noteData = [
                'note_id' => $note_id, // Identifiant unique de la note
                'note' => isset($absences[$note_id]) ? 'abs' : $note_value, // Si l'étudiant est absent, on stocke 'abs'
            ];

            // Mettre à jour la colonne "note" uniquement
            if (!$noteModel->update($note_id, $noteData)) {
                // En cas d'erreur, rediriger avec les erreurs
                return redirect()->back()->withInput()->with('errors', $noteModel->errors());
            }
        }

        // Rediriger avec un message de succès
        return redirect()->to('/notesFinal/' . $exam_id)->with('success', 'Notes enregistrées avec succès');
    }

    public function notesList($exam_id)
    {
        $examModel = new ExamModel();
        $exam = $examModel->find($exam_id);

        if (!$exam) {
            return redirect()->to('/examsList')->with('error', 'Examen non trouvé.');
        }

        // Vérifier si l'utilisateur a accès à cet examen (ajouter la logique d'accès)
        // Par exemple : vérifier si l'utilisateur est un professeur lié à cet examen

        $noteModel = new NoteModel();
        $notes = $noteModel->getNotesForExam($exam_id);

        if (empty($notes)) {
            return redirect()->to('notesList')->with('error', 'Aucune note trouvée pour cet examen.');
        }

        return view('notesList', [
            'exam' => $exam,
            'notes' => $notes,
        ]);
    }

    public function delete($note_id)
    {
        $noteModel = new NoteModel();
        $noteModel->delete($note_id);

        return redirect()->to('/notesList');
    }

    public function update($note_id)
    {
        // Implémenter la logique de mise à jour ici
    }

    public function add()
    {
        // Implémenter la logique d'ajout ici
    }
}