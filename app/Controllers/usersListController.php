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
        $compte = $compteModel->find($user_id); // Récupérer les informations du compte de l'utilisateur connecté

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
}