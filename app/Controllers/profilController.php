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

        // Définissez la page active
        $currentPage = 'profil';

        // Passez les données de l'utilisateur et la page actuelle à la vue
        return view('profil', [
            'compte' => $compte,
            'currentPage' => $currentPage,
        ]);
    }
}