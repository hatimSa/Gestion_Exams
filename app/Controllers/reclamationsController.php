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

        // Si l'utilisateur est un administrateur (role_id = 3)
        if ($compte['role_id'] == 3) {
            // Administrateur peut voir toutes les réclamations
            $reclamationModel = new ReclamationModel();
            $reclamations = $reclamationModel->getAllReclamations();
        }
        // Si l'utilisateur est un professeur (role_id = 2)
        elseif ($compte['role_id'] == 2) {
            // Professeur peut voir seulement les réclamations des étudiants qu'il supervise
            $reclamationModel = new ReclamationModel();
            $reclamations = $reclamationModel->getReclamationsByProfessor($user_id);
        } else {
            // Si l'utilisateur n'est ni admin ni prof, redirection vers la page d'accueil
            return redirect()->to('/home');
        }

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
        if ($compte['role_id'] != 3) {
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

    public function response($id)
    {
        $status = $this->request->getPost('etat'); // Récupère la valeur envoyée du formulaire

        // Validation du statut
        $allowedStatuses = ['En cours', 'Bien Traité', 'Rien à changer'];
        if (!in_array($status, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Statut non valide.');
        }

        // Chargement du modèle et mise à jour
        $reclamationModel = new \App\Models\ReclamationModel();
        $updated = $reclamationModel->update($id, ['etat' => $status]);

        if ($updated) {
            return redirect()->back()->with('success', 'Le statut a été mis à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour.');
        }
    }

    // Fonction pour déconnecter l'utilisateur
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}