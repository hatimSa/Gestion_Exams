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
    $validation = \Config\Services::validation();

    // Règles de validation
    $validation->setRules([
        'first_name'   => 'required|min_length[3]',
        'last_name'    => 'required|min_length[3]',
        'email'        => 'required|valid_email|is_unique[users.email]|is_unique[comptes.email]',
        'phone_number' => 'required|numeric|min_length[8]',
        'password'     => 'required|min_length[8]',
        'status'       => 'required|in_list[pending,accepted,rejected]' // Validation de 'status'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        // Si des erreurs de validation existent, afficher le formulaire avec les erreurs
        return view('register', [
            'validation' => $validation,
            'currentPage' => 'register'
        ]);
    }

    // Récupérer les données du formulaire
    $firstName = $this->request->getPost('first_name');
    $lastName = $this->request->getPost('last_name');
    $email = $this->request->getPost('email');
    $phoneNumber = $this->request->getPost('phone_number');
    $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    $status = $this->request->getPost('status'); // "status" du formulaire

    // Convertir le status en valeur correspondante pour "etat"
    $etat = $status; // Utilise directement la valeur de 'status' (qui doit être 'pending', 'accepted', ou 'rejected')

    $compteModel = new CompteModel();
    $userModel = new UserModel();

    // Vérifier si l'email existe déjà
    if ($compteModel->where('email', $email)->first() || $userModel->where('email', $email)->first()) {
        return view('register', [
            'validation' => $validation,
            'error' => 'Cet email est déjà utilisé.',
            'currentPage' => 'register'
        ]);
    }

    // Insérer les données dans la table "comptes"
    $compteData = [
        'first_name'   => $firstName,
        'last_name'    => $lastName,
        'email'        => $email,
        'password'     => $password,
        'phone_number' => $phoneNumber,
        'etat'         => $etat, // Utilisation de la valeur du statut
    ];

    // Vérifie si l'insertion se fait correctement
    if (!$compteModel->insert($compteData)) {
        return view('register', [
            'validation' => $validation,
            'error' => 'Une erreur est survenue lors de l\'insertion des données.',
            'currentPage' => 'register'
        ]);
    }

    $compteId = $compteModel->getInsertID();

    // Insérer les données dans la table "users"
    $userData = [
        'email'     => $email,
        'password'  => $password,
        'compte_id' => $compteId,
    ];
    $userModel->insert($userData);

    // Rediriger avec un message de succès
    return redirect()->to('/login')->with('success', 'Inscription réussie. Vous pouvez vous connecter.');
}

}
