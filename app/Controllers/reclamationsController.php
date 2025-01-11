<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ReclamationsController extends Controller
{
    public function index()
    {
        $currentPage = 'reclamations';
        return view('reclamations', [
            'currentPage' => $currentPage,
        ]);
    }
}