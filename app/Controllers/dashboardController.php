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

        // Passer les informations de l'utilisateur et du compte à la vue
        return view('dashboard', ['user' => $user, 'compte' => $compte]);
    }
}