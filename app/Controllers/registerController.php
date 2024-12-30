<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register'); // Display the registration form
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        // Validation rules
        $validation->setRules([
            'first_name'  => 'required|min_length[3]',
            'last_name'   => 'required|min_length[3]',
            'email'       => 'required|valid_email|is_unique[users.email]|is_unique[comptes.email]',
            'phone_number' => 'required|numeric|min_length[8]',
            'password'    => 'required|min_length[8]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, display errors
            return view('register', [
                'validation' => $validation
            ]);
        }

        // Retrieve form data
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $phoneNumber = $this->request->getPost('phone_number');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Insert data into `comptes` table
        $compteModel = new CompteModel();
        $compteData = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'password'     => $password,
            'phone_number' => $phoneNumber,
            'etat'         => 1, // Default value for `etat`
        ];
        $compteModel->insert($compteData);
        $compteId = $compteModel->getInsertID();

        // Insert data into `users` table
        $userModel = new UserModel();
        $userData = [
            'email'     => $email,
            'password'  => $password,
            'compte_id' => $compteId,
        ];
        $userModel->insert($userData);

        // Redirect to login page
        return redirect()->to('/login')->with('success', 'Inscription réussie. Vous pouvez vous connecter.');
    }
}
