<?php

namespace App\Controllers;

use App\Models\UserModel;

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
        $userModel = new UserModel();
        $user = $userModel->find($user_id);  // Récupérer les données de l'utilisateur par son ID

        // Passer les informations de l'utilisateur à la vue
        return view('dashboard', ['user' => $user]);
    }
}