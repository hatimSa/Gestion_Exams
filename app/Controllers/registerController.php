<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use App\Models\DepartementModel;
use App\Models\FiliereModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    protected $departementModel;
    protected $filiereModel;

    public function __construct()
    {
        // Charger les modèles nécessaires
        $this->departementModel = new DepartementModel();
        $this->filiereModel = new FiliereModel();
    }

    public function index()
    {
        // Récupérer tous les départements et filières
        $departements = $this->departementModel->findAll();
        $filieres = $this->filiereModel->findAll();

        // Passer les variables à la vue
        return view('register', [
            'departements' => $departements,
            'filieres' => $filieres
        ]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        // Validation des champs du formulaire
        $validation->setRules([
            'first_name'   => 'required|min_length[3]',
            'last_name'    => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]|is_unique[comptes.email]',
            'departement_id'  => 'required|integer',
            'filiere_id'  => 'required|integer',
            'phone_number' => 'required|numeric|min_length[8]',
            'password'     => 'required|min_length[8]',
            'role_id'      => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Si la validation échoue, renvoyer à la vue avec les erreurs
            return view('register', [
                'validation' => $validation,
                'departements' => $this->departementModel->findAll(),
                'filieres' => $this->filiereModel->findAll()
            ]);
        }

        // Récupérer les données du formulaire
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $departement = $this->request->getPost('departement_id');
        $filiere = $this->request->getPost('filiere_id');
        $phoneNumber = $this->request->getPost('phone_number');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $roleId = $this->request->getPost('role_id');

        $compteModel = new CompteModel();
        $userModel = new UserModel();

        // Insérer dans la table "comptes"
        $compteData = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'departement_id'  => $departement,
            'filiere_id'  => $filiere,
            'password'     => $password,
            'phone_number' => $phoneNumber,
            'role_id'      => $roleId,
            'user_id'      => null,  // Laisser null ou définir explicitement ici
        ];

        if (!$compteModel->insert($compteData)) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout dans la table comptes.');
        }

        // Récupérer l'ID du dernier compte inséré
        $compteId = $compteModel->getInsertID();

        if (!$compteId) {
            return redirect()->back()->withInput()->with('error', 'Erreur : impossible de récupérer l\'ID du compte.');
        }

        // Assurer que user_id dans comptes correspond à compte_id après insertion
        $compteModel->update($compteId, ['user_id' => $compteId]);

        // Maintenant insérer dans la table "users"
        $userData = [
            'email'     => $email,
            'password'  => $password,
            'compte_id' => $compteId,
            'user_id'   => $compteId, // Cela doit correspondre à compte_id
        ];

        if (!$userModel->insert($userData)) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout dans la table users.');
        }

        // Rediriger vers la page de connexion avec un message de succès
        return redirect()->to('/login')->with('success', 'Utilisateur ajouté avec succès.');
    }
}