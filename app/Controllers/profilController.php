<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompteModel;

class ProfilController extends Controller
{
    public function index()
    {
        $session = session();

        // Vérifiez si l'utilisateur est connecté
        if (!$session->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérez les informations de l'utilisateur depuis la base de données
        $compteModel = new CompteModel();
        $compte = $compteModel->where('user_id', $session->get('user_id'))->first();

        if (!$compte) {
            return redirect()->to('/login')->with('error', 'Utilisateur introuvable.');
        }

        $role = $compte['role_id'];
        $currentPage = 'profil';

        // Passez les données de l'utilisateur et la page actuelle à la vue
        return view('profil', [
            'compte' => $compte,
            'currentPage' => $currentPage,
            'role' => $role
        ]);
    }

    public function logout()
    {
        // Supprimer la session et rediriger vers la page de connexion
        session()->destroy();
        return redirect()->to('/login');
    }
}