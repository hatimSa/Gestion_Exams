<?php

namespace App\Controllers;

class ManageExams extends BaseController
{
    public function index()
    {
        // Aucune donnée à récupérer depuis la base de données
        // Vous pouvez passer des données statiques si nécessaire, sinon laissez vide
        $data['currentPage'] = 'manageExams'; // Pour l'activation de la classe active sur la sidebar

        // Charger la vue avec les données
        return view('manage-exams', $data);
    }
}
