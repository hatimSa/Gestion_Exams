<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ProfController extends Controller
{
    public function index()
    {
        // Données fictives pour le professeur
        $compte = (object) [
            'first_name' => 'Jahn',
            'last_name' => 'Smith'
        ];

        // Données fictives pour les résultats des étudiants
        $studentResults = [
            ['student_name' => 'Alice', 'exam_name' => 'Math Exam', 'score' => 85],
            ['student_name' => 'Bob', 'exam_name' => 'History Exam', 'score' => 90],
            ['student_name' => 'Charlie', 'exam_name' => 'Physics Exam', 'score' => 78]
        ];

        // Passer les données à la vue
        return view('profDashboard', [
            'compte' => $compte,
            'studentResults' => $studentResults
        ]);
    }
}