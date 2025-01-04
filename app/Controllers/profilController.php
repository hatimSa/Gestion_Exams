<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompteModel;
use App\Models\UserModel;

class ProfilController extends Controller
{
    // ProfilController.php
    public function index()
    {
        $session = session();

        // Vérifiez si l'utilisateur est connecté
        if (!$session->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérez les informations de l'utilisateur depuis la session ou la base de données
        $compteModel = new \App\Models\CompteModel();
        $compte = $compteModel->where('user_id', $session->get('user_id'))->first(); // Utilisez 'user_id' ici

        if (!$compte) {
            return redirect()->to('/login')->with('error', 'Utilisateur introuvable.');
        }

        // Passez les données de l'utilisateur à la vue
        return view('profil', ['compte' => $compte]);
    }
}