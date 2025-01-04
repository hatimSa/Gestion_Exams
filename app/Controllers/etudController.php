<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class EtudController extends Controller
{
    public function index()
    {
        // Données fictives pour tester la vue
        $compte = (object) [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ];

        // Données fictives pour les examens et résultats
        $upcomingExams = [
            ['exam_name' => 'Math Exam', 'exam_date' => '2025-01-10'],
            ['exam_name' => 'History Exam', 'exam_date' => '2025-01-15']
        ];

        $recentResults = [
            ['exam_name' => 'Math Exam', 'score' => 85],
            ['exam_name' => 'History Exam', 'score' => 92]
        ];

        // Passer les données à la vue
        return view('etudDashboard', [
            'compte' => $compte,
            'upcomingExams' => $upcomingExams,
            'recentResults' => $recentResults
        ]);
    }
}