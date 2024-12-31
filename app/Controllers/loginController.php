<?php

namespace App\Controllers;

use App\Models\UserModel;
class LoginController extends BaseController
{
    public function index()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }
        return view('login');
    }

    public function login()
    {
        // Validation des champs
        $validation = $this->validate([
            'Email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', 'Invalid form data.');
        }

        // Récupérer les données du formulaire
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('password');

        // Charger le modèle
        $userModel = new UserModel();

        // Rechercher l'utilisateur
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            session()->set([
                'user_id' => $user['user_id'],
                'email' => $user['email'],
            ]);
            return redirect()->to('/dashboard');
        }

        // Authentification échouée
        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}