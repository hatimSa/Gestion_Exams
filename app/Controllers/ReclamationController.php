<?php

namespace App\Controllers;

use App\Models\ReclamationModel;

class ReclamationController extends BaseController
{
    public function index()
    {
        $reclamationModel = new ReclamationModel();
        $reclamations = $reclamationModel->findAll();

        return view('reclamations', ['reclamations' => $reclamations]);
    }
}
