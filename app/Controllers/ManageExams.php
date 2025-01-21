<?php

namespace App\Controllers;

class ManageExams extends BaseController
{
    public function index()
    {
       
        
        $data['currentPage'] = 'manageExams'; // Pour l'activation de la classe active sur la sidebar

        // Charger la vue avec les données
        return view('manage-exams', $data);
    }
}
