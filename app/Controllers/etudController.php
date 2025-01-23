<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use App\Models\ExamModel;
use App\Models\NoteModel;

class EtudController extends BaseController
{
    public function index()
    {
        // Crée une instance des modèles nécessaires
        $examModel = new ExamModel();
        $resultModel = new NoteModel();

        // Récupère les examens à venir
        $upcomingExams = $examModel->getUpcomingExams(session()->get('user_id'));

        // Récupère les résultats récents
        $recentResults = $resultModel->getRecentResults(session()->get('user_id'));

        // Passe les données à la vue
        return view('etudDashboard', [
            'upcomingExams' => $upcomingExams,
            'recentResults' => $recentResults,
            'compte' => session()->get('user_data') // Assurez-vous que les données de l'utilisateur sont stockées dans la session
        ]);
    }

    public function logout()
    {
        // Supprimer toutes les données de session
        session()->destroy();

        // Rediriger vers la page de connexion
        return redirect()->to('/login');
    }
}