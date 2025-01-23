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
}