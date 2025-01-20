<?php

namespace App\Controllers;

use App\Models\ResultModel;

class ResultController extends BaseController
{
    public function index()
    {
        
        $data['currentPage']='result';
        return view('result', $data); // Passe les données à la vue
    }
}
