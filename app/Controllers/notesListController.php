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

    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            $notes = $this->request->getPost('notes');
            $absences = $this->request->getPost('abs');  // Récupérer les absences

            if (!$notes) {
                return redirect()->to('/notesList')->with('error', 'Aucune donnée soumise.');
            }

            $noteModel = new NoteModel();

            foreach ($notes as $noteId => $noteValue) {
                // Si l'étudiant est absent (case cochée), on marque "abs"
                if (isset($absences[$noteId])) {
                    $data['note'] = 'abs';
                } else {
                    // Validation de la note : soit une valeur numérique, soit "abs"
                    if ($noteValue !== 'abs' && (!is_numeric($noteValue) || $noteValue < 0 || $noteValue > 20)) {
                        return redirect()->to('/notesList')->with('error', 'Toutes les notes doivent être comprises entre 0 et 20 ou marquées comme "abs".');
                    }
                    $data['note'] = $noteValue;
                }

                // Mise à jour ou insertion
                $noteModel->update($noteId, $data);
            }

            return redirect()->to('/notesFinal')->with('success', 'Les notes ont été enregistrées avec succès.');
        }

        return redirect()->to('/notesList')->with('error', 'Aucune donnée soumise.');
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