<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;

class DashboardController extends BaseController
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
        $compte = $compteModel->where('compte_id', $user['compte_id'])->first(); // Récupérer les informations du compte

        // Vérifier si le role_id est égal à 3 (admin)
        if ($compte['role_id'] != 3) {
            // Si le role_id n'est pas 3, rediriger vers une autre page (par exemple, page d'accueil)
            return redirect()->to('/home');
        }

        // Récupérer les 3 derniers étudiants et professeurs
        $students = $compteModel->getLatestStudents();
        $professors = $compteModel->getLatestProfessors();

        $currentPage = 'dashboard';

        // Passer les informations de l'utilisateur, du compte, les étudiants et les professeurs à la vue
        return view('dashboard', [
            'user' => $user,
            'compte' => $compte,
            'students' => $students,
            'professors' => $professors,
            'currentPage' => $currentPage,
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}