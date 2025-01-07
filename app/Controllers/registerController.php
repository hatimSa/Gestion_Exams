<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        // Display the registration form with the active page
        return view('register', ['currentPage' => 'register']);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        // Validation rules
        $validation->setRules([
            'first_name'   => 'required|min_length[3]',
            'last_name'    => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]|is_unique[comptes.email]',
            'phone_number' => 'required|numeric|min_length[8]',
            'password'     => 'required|min_length[8]',
            'role_id'      => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('register', [
                'validation' => $validation,
                'currentPage' => 'register'
            ]);
        }

        // Retrieve form data
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $phoneNumber = $this->request->getPost('phone_number');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $roleId = $this->request->getPost('role_id');

        $compteModel = new CompteModel();
        $userModel = new UserModel();

        // Insert into "comptes" table
        $compteData = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'password'     => $password,
            'phone_number' => $phoneNumber,
            'role_id'      => $roleId,
            'user_id'      => null,  // Leave it null or set it explicitly here
        ];

        if (!$compteModel->insert($compteData)) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout dans la table comptes.');
        }

        // Retrieve the last inserted compte ID
        $compteId = $compteModel->getInsertID();

        if (!$compteId) {
            return redirect()->back()->withInput()->with('error', 'Erreur : impossible de récupérer l\'ID du compte.');
        }

        // Ensure user_id in comptes matches the compte_id after inserting
        $compteModel->update($compteId, ['user_id' => $compteId]);

        // Now insert into the users table
        $userData = [
            'email'     => $email,
            'password'  => $password,
            'compte_id' => $compteId,
            'user_id'   => $compteId, // This should match compte_id
        ];

        if (!$userModel->insert($userData)) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout dans la table users.');
        }

        // Redirect to user list with success message
        return redirect()->to('/login')->with('success', 'Utilisateur ajouté avec succès.');
    }
}