<?php

namespace App\Controllers;

use App\Models\CompteModel;

class ProfilController extends BaseController
{
    public function index()
    {
        // Récupérer l'ID de l'utilisateur connecté
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login'); // Rediriger si l'utilisateur n'est pas connecté
        }

        // Charger le modèle pour récupérer les informations du compte
        $compteModel = new CompteModel();
        $compte = $compteModel->where('compte_id', $userId)->first(); // Récupérer les données du compte

        if (!$compte) {
            // Si le compte n'existe pas
            session()->setFlashdata('error', 'Utilisateur introuvable.');
            return redirect()->to('/login');
        }

        // Passer les données à la vue
        return view('profil', ['compte' => $compte]);
    }
}
?>