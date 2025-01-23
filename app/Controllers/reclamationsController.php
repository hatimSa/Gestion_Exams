<?php

namespace App\Controllers;

use App\Models\ReclamationModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class ReclamationsController extends Controller
{
    // Fonction pour afficher toutes les réclamations
    public function index()
    {
        // Vérification de l'authentification de l'utilisateur
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
    
        // Récupérer l'ID de l'utilisateur actuel et son rôle
        $user_id = session()->get('user_id');
        $compteModel = new CompteModel();
        $compte = $compteModel->find($user_id);
    
        // Vérifier que l'utilisateur a un rôle d'administrateur
        if ($compte['role_id'] != 3) {
            return redirect()->to('/home');
        }
    
        // Charger les réclamations avec les noms des utilisateurs
        $reclamationModel = new ReclamationModel();
        $reclamations = $reclamationModel->getAllReclamations();
    
        // Passer les données à la vue
        $currentPage = 'reclamations';
        return view('reclamations', [
            'currentPage' => $currentPage,
            'reclamations' => $reclamations,
        ]);
    }
    
    // Fonction pour supprimer une réclamation
    public function delete($id)
    {
        // Vérification de l'authentification de l'utilisateur
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Récupérer l'ID de l'utilisateur actuel et son rôle
        $user_id = session()->get('user_id');
        $compteModel = new CompteModel();
        $compte = $compteModel->find($user_id);

        // Vérifier que l'utilisateur a un rôle d'administrateur
        if (!$compte || $compte['role_id'] != 3) {
            return redirect()->to('/home');
        }

        // Instancier le modèle des réclamations
        $reclamationModel = new ReclamationModel();

        // Vérifier si la réclamation existe
        $reclamation = $reclamationModel->find($id);

        if ($reclamation) {
            // Suppression de la réclamation
            $reclamationModel->delete($id);

            // Redirection avec un message de succès
            return redirect()->to('/reclamations')->with('message', 'Réclamation supprimée avec succès.');
        } else {
            // Si la réclamation n'existe pas
            return redirect()->to('/reclamations')->with('error', 'Réclamation non trouvée.');
        }
    }

    // Fonction pour déconnecter l'utilisateur
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
