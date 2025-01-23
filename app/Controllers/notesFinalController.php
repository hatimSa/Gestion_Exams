<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\ExamModel;

class NotesFinalController extends BaseController
{
    public function index($exam_id = null)
    {
        $noteModel = new NoteModel();
        $prof_id = session()->get('user_id'); // ID du professeur connecté

        if ($exam_id) {
            // Cas où un $exam_id est fourni : afficher les notes pour un examen spécifique
            $data['notes'] = $noteModel->getNotesForExam($exam_id);
        } else {
            // Cas où aucun $exam_id n'est fourni : afficher les notes de tous les examens du professeur
            $data['notes'] = $noteModel->getNotesForProfessor($prof_id);
        }

        $notes = $noteModel->getNotesGroupedByModule($prof_id);

        return view('notesFinal', ['notesGrouped' => $notes]);
    }

    public function update()
    {
        $noteModel = new NoteModel();
    
        // Récupérer l'ID de la note à modifier
        $note_id = $this->request->getPost('save_note');
        $newNote = $this->request->getPost('notes')[$note_id] ?? null;
    
        // Vérifier si la note est valide
        if ($newNote !== null && is_numeric($newNote) && $newNote >= 0 && $newNote <= 20) {
            $noteModel->update($note_id, ['note' => $newNote]);
    
            // Message flash de succès
            return redirect()->to('/notesFinal')->with('success', 'La note a été mise à jour avec succès.');
        }
    
        // Message flash d'erreur
        return redirect()->to('/notesFinal')->with('error', 'Échec de la mise à jour de la note.');
    }

}