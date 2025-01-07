<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;

class EtudController extends BaseController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            // Si non connecté, rediriger vers la page de connexion
            return redirect()->to('/login');
        }

        // Récupérer les informations de l'utilisateur depuis la session
        $user_id = session()->get('user_id');

        // Charger les modèles
        $userModel = new UserModel();
        $compteModel = new CompteModel();

        // Récupérer les données de l'utilisateur
        $user = $userModel->find($user_id);

        // Récupérer les données du compte associé
        $compte = $compteModel->where('compte_id', $user['compte_id'])->first();

        // Vérifier si le role_id est égal à 1 (etudiant)
        if ($compte['role_id'] != 1) {
            // Si le role_id n'est pas 1, rediriger vers une autre page (par exemple, page d'accueil)
            return redirect()->to('/home');
        }

        // Données fictives pour les examens et résultats
        $upcomingExams = [
            ['exam_name' => 'Math Exam', 'exam_date' => '2025-01-10'],
            ['exam_name' => 'History Exam', 'exam_date' => '2025-01-15']
        ];

        $recentResults = [
            ['exam_name' => 'Math Exam', 'score' => 85],
            ['exam_name' => 'History Exam', 'score' => 92]
        ];

        // Passer les données à la vue
        return view('etudDashboard', [
            'compte' => $compte,
            'upcomingExams' => $upcomingExams,
            'recentResults' => $recentResults
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