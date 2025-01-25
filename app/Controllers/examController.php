<?php

namespace App\Controllers;

use App\Models\ExamModel;

class ExamController extends BaseController
{
    public function index()
    {
        // Crée une instance du modèle ExamModel
        $examModel = new ExamModel();

        // Récupère l'ID de l'utilisateur connecté
        $user_id = session()->get('user_id'); // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

        // Récupère les examens filtrés pour les étudiants en fonction de leur filière et département
        $exams = $examModel->getExamsForStudentWithFiliereAndDepartementName($user_id);

        // Vérification de la date de chaque examen
        foreach ($exams as $exam) {
            if ($exam->exam_date === '0000-00-00') {
                $exam->exam_date = "Date non définie"; // Remplacer la date invalide
            }
        }

        // Définir la variable pour la page actuelle
        $currentPage = 'exams_view';

        // Passe les données à la vue
        return view('exams_view', ['exams' => $exams, 'currentPage' => $currentPage]);
    }
}