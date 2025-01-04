<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        // Afficher le formulaire d'inscription avec la page active
        return view('register', ['currentPage' => 'register']);
    }

    public function store()
    {
        // Récupérer les données du formulaire
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $phone_number = $this->request->getPost('phone_number');
        $etat = $this->request->getPost('etat');
        $role_id = $this->request->getPost('role_id');

        // Validation des données
        if (!$this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email|is_unique[comptes.email]',
            'password' => 'required|min_length[8]',
        ])) {
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Créer l'utilisateur dans la table comptes
        $compteModel = new CompteModel();
        $compteData = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone_number' => $phone_number,
            'role_id' => $role_id,
            'etat' => $etat,
        ];

        if ($compteModel->save($compteData)) {
            // Récupérer l'ID du compte créé
            $compte_id = $compteModel->getInsertID();

            // Créer l'utilisateur dans la table users
            $userModel = new UserModel();
            $userData = [
                'email' => $email,
                'password' => $hashedPassword,
                'compte_id' => $compte_id,  // Utilisation de compte_id
            ];

            if ($userModel->insertUser($userData)) {
                // Récupérer l'ID de l'utilisateur créé
                $user_id = $userModel->getInsertID();

                // Mettre à jour la table comptes avec l'ID de l'utilisateur
                $compteModel->update($compte_id, ['user_id' => $user_id]);

                return redirect()->to('/login')->with('success', 'Inscription réussie !');
            } else {
                return redirect()->to('/register')->with('errors', ['Erreur lors de l\'ajout de l\'utilisateur dans la table users.']);
            }
        } else {
            return redirect()->to('/register')->with('errors', ['Erreur lors de l\'ajout du compte dans la table comptes.']);
        }
    }
}