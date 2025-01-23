<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\CompteModel;
use App\Models\NoteModel;

class ProfController extends Controller
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
        $noteModel = new NoteModel(); // Charger le modèle des notes

        // Récupérer les données de l'utilisateur
        $user = $userModel->find($user_id);

        // Récupérer les données du compte associé
        $compte = $compteModel->where('compte_id', $user['compte_id'])->first();

        // Vérifier si le role_id est égal à 2 (professeur)
        if ($compte['role_id'] != 2) {
            // Si le role_id n'est pas 2, rediriger vers une autre page (par exemple, page d'accueil)
            return redirect()->to('/home');
        }

        // Récupérer les 3 meilleurs résultats pour le professeur
        $studentResults = $noteModel->getStudentResultsForProfessor($user_id);

        // Passer les données à la vue
        return view('profDashboard', [
            'compte' => $compte,
            'studentResults' => $studentResults,
            'currentPage' => 'profDashboard'
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