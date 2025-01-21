<?php 
namespace App\Controllers;

class listeResultController extends BaseController
{
    public function index()
    {
        $data['currentPage']="student-results";
        // Charger la vue
        return view('manage_results', $data);
    }
}