<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use App\Models\DepartementModel;
use App\Models\FiliereModel;
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

        // Récupérer les départements
        $departementModel = new DepartementModel();
        $departements = $departementModel->findAll(); // Récupère tous les départements

        // Récupérer les filières
        $filiereModel = new FiliereModel();
        $filieres = $filiereModel->findAll(); // Récupère toutes les filières

        // Afficher le formulaire avec les départements et les filières
        return view('usersAdd', [
            'departements' => $departements, // Transmettre les départements à la vue
            'filieres' => $filieres, // Transmettre les filières à la vue
            'currentPage' => 'usersAdd'
        ]);
    }


    public function store()
    {
        $validation = \Config\Services::validation();

        // Validation rules
        $validation->setRules([
            'first_name'   => 'required|min_length[3]',
            'last_name'    => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]|is_unique[comptes.email]',
            'departement_id'  => 'required|integer',
            'filiere_id'  => 'required|integer',
            'phone_number' => 'required|numeric|min_length[8]',
            'password'     => 'required|min_length[8]',
            'etat'       => 'required|in_list[pending,accepted,rejected]',
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
        $departement = $this->request->getPost('departement_id');
        $filiere = $this->request->getPost('filiere_id');
        $phoneNumber = $this->request->getPost('phone_number');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $status = $this->request->getPost('etat');
        $roleId = $this->request->getPost('role_id'); // Ensure role_id is received correctly

        $compteModel = new CompteModel();
        $userModel = new UserModel();

        $departementModel = new DepartementModel();
        $filiereModel = new FiliereModel();

        // Insert into "comptes" table
        $compteData = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'departement_id'  => $departement,
            'filiere_id'  => $filiere,
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

    public function getFilieresByDepartement($departement_id)
    {
        $filiereModel = new FiliereModel();

        // Récupérer les filières pour le département donné
        $filieres = $filiereModel->where('departement_id', $departement_id)->findAll();

        // Retourner les filières au format JSON
        return $this->response->setJSON($filieres);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}