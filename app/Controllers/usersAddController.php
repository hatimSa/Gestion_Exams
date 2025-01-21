<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class UsersAddController extends Controller
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

        // Display the registration form with the active page
        return view('usersAdd', ['currentPage' => 'usersAdd']);
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
            'status'       => 'required|in_list[pending,accepted,rejected]',
            'role_id'      => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('usersAdd', [
                'validation' => $validation,
                'currentPage' => 'usersAdd'
            ]);
        }

        // Retrieve form data
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $phoneNumber = $this->request->getPost('phone_number');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $status = $this->request->getPost('status');
        $roleId = $this->request->getPost('role_id'); // Ensure role_id is received correctly

        $compteModel = new CompteModel();
        $userModel = new UserModel();

        // Insert into "comptes" table
        $compteData = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'password'     => $password,
            'phone_number' => $phoneNumber,
            'etat'         => $status,
            'role_id'      => $roleId,
            'user_id'      => null,  // Leave it null or set it explicitly here
        ];

        if (!$compteModel->insert($compteData)) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout dans la table comptes.');
        }

        $compteId = $compteModel->getInsertID();

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
        return redirect()->to('/usersList')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}