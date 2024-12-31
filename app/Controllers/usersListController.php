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

        // Passer les données à la vue
        return view('usersList', ['comptes' => $comptes]);
    }
}