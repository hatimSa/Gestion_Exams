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
                session()->set('user_id', $user['user_id']);
                session()->set('email', $user['email']);

                // Rediriger vers le tableau de bord
                return redirect()->to('/dashboard');
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

    public function logout()
    {
        // Déconnecter l'utilisateur
        session()->destroy();
        return redirect()->to('/login');
    }
}