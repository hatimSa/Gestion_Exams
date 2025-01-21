<?php

namespace App\Controllers;

use App\Models\ExamModel;

class ExamsListController extends BaseController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Charger le modèle
        $examModel = new ExamModel();

        // Récupérer la liste des exams avec les noms des filières et des départements
        $exams = $examModel->select('exams.*, filieres.filiere_name, departements.departement_name')
            ->join('filieres', 'exams.filiere_id = filieres.filiere_id')
            ->join('departements', 'filieres.departement_id = departements.departement_id')
            ->findAll();

        // Définir la variable currentPage
        $currentPage = 'examsList';

        // Passer les données et la page actuelle à la vue
        return view('examsList', [
            'exams' => $exams,
            'currentPage' => $currentPage,
        ]);
    }
}