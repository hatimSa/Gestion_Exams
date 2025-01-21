<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class ReclamationsController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $user_id = session()->get('user_id');
        $compteModel = new CompteModel();
        $compte = $compteModel->find($user_id);

        if ($compte['role_id'] != 3) {
            return redirect()->to('/home');
        }

        $currentPage = 'reclamations';
        return view('reclamations', [
            'currentPage' => $currentPage,
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}