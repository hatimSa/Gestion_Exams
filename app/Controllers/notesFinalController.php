<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\ExamModel;

class NotesFinalController extends BaseController
{
    public function index()
    {
        $noteModel = new NoteModel();
        $examModel = new ExamModel();

        // Supposons que tu récupères l'ID de l'examen d'une manière ou d'une autre
        $exam_id = 1; // Remplace par la logique appropriée pour récupérer l'examen

        // Récupérer les détails de l'examen
        $exam = $examModel->find($exam_id);

        // Si l'examen n'existe pas, tu peux rediriger ou gérer l'erreur
        if (!$exam) {
            return redirect()->to('/examsList')->with('error', 'Examen non trouvé.');
        }

        // Récupérer les notes avec les détails des étudiants
        $data['notes'] = $noteModel->getNotesForExam($exam_id);
        $data['exam'] = $exam; // Passer les détails de l'examen à la vue

        return view('notesFinal', $data);
    }
}