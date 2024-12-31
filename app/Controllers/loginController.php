<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        // Afficher le formulaire de connexion
        return view('login');
    }

    public function login()
    {
        $validation = \Config\Services::validation();

        // Validation des données
        $validation->setRules([
            'Email' => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('error', 'Invalid input data.');
            return redirect()->to('/login');
        }

        // Récupérer les données du formulaire
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('password');

        // Charger le modèle pour interagir avec la base de données
        $userModel = new UserModel();

        // Vérifier si l'utilisateur existe
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Authentification réussie, stocker l'ID de l'utilisateur dans la session
                session()->set('is_logged_in', true);
                session()->set('user_id', $user['user_id']);
                session()->set('email', $user['email']);

                // Rediriger vers le tableau de bord ou la page d'origine
                return redirect()->to(session()->get('redirect_url') ?? '/dashboard');
            } else {
                // Mot de passe incorrect
                session()->setFlashdata('error', 'Invalid password.');
                return redirect()->to('/login');
            }
        } else {
            // Utilisateur non trouvé
            session()->setFlashdata('error', 'No user found with that email.');
            return redirect()->to('/login');
        }
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function logout()
    {
        // Déconnecter l'utilisateur
        session()->destroy();
        return redirect()->to('/login');
    }
}