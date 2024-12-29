<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');  // Affiche le formulaire d'inscription
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        // Valider les données envoyées
        $validation->setRules([
            'first_name' => 'required|min_length[3]',
            'last_name'  => 'required|min_length[3]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'password'   => 'required|min_length[8]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Si la validation échoue, afficher à nouveau le formulaire avec les erreurs
            return view('register', [
                'validation' => $this->validator
            ]);
        }

        // Récupérer les données du formulaire
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Enregistrer dans la base de données
        $userModel = new UserModel();
        $userModel->save($data);

        // Rediriger vers la page de connexion ou dashboard
        return redirect()->to('/login');
    }
}