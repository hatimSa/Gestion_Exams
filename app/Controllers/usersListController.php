<?php

namespace App\Controllers;

use App\Models\CompteModel;

class UsersListController extends BaseController
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
    
        // Charger le modèle
        $compteModel = new CompteModel();
    
        // Récupérer les données du compte de l'utilisateur
        $compte = $compteModel->find($user_id);
    
        // Vérifier si le compte existe
        if ($compte === null) {
            // Si le compte n'existe pas, rediriger vers une autre page avec un message d'erreur
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }
    
        // Vérifier si le role_id est égal à 3 (admin)
        if ($compte['role_id'] != 3) {
            // Si le role_id n'est pas 3, rediriger vers une autre page (par exemple, page d'accueil)
            return redirect()->to('/home');
        }
    
        // Récupérer les comptes avec leurs rôles
        $comptes = $compteModel->getAllComptesWithRoles();
    
        // Ajouter la variable $currentPage pour identifier la page active
        $currentPage = 'usersList';
    
        // Passer les données et la page actuelle à la vue
        return view('usersList', [
            'comptes' => $comptes,
            'currentPage' => $currentPage,
        ]);
    }
    public function delete($id)
{
    // Vérifier si l'utilisateur est connecté
    if (!session()->has('user_id')) {
        return redirect()->to('/login');
    }

    // Charger le modèle
    $compteModel = new CompteModel();

    // Vérifier si le compte existe
    $compte = $compteModel->find($id);

    // Si le compte n'existe pas, rediriger avec un message d'erreur
    if (!$compte) {
        return redirect()->to('/usersList')->with('error', 'Compte introuvable.');
    }

    // Supprimer le compte
    if ($compteModel->delete($id)) {
        // Rediriger avec un message de succès
        return redirect()->to('/usersList')->with('success', 'Compte supprimé avec succès.');
    } else {
        // Rediriger avec un message d'erreur en cas d'échec de suppression
        return redirect()->to('/usersList')->with('error', 'Une erreur est survenue lors de la suppression.');
    }
}

    

}

