<?php

namespace App\Controllers;

use App\Models\CompteModel;

class UsersListController extends BaseController
{
    public function index()
    {
        $compteModel = new CompteModel();

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