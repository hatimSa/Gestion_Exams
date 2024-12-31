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

        // ✅ Règles de validation
        $validation->setRules([
            'first_name'   => 'required|min_length[3]',
            'last_name'    => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]|is_unique[comptes.email]',
            'phone_number' => 'required|numeric|min_length[8]',
            'password'     => 'required|min_length[8]',
            'status'       => 'required|in_list[active,inactive]' // Le champ "status" devient "etat" dans la BDD
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // ❌ En cas d'erreurs de validation, afficher le formulaire avec les erreurs
            return view('register', [
                'validation' => $validation,
                'currentPage' => 'register'
            ]);
        }

        try {
            // ✅ Récupérer les données du formulaire
            $firstName = $this->request->getPost('first_name');
            $lastName = $this->request->getPost('last_name');
            $email = $this->request->getPost('email');
            $phoneNumber = $this->request->getPost('phone_number');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $status = $this->request->getPost('status'); // Champ "status" dans le formulaire

            $compteModel = new CompteModel();
            $userModel = new UserModel();

            // ✅ Vérifier si l'email existe déjà (redondant avec `is_unique`)
            if ($compteModel->where('email', $email)->first() || $userModel->where('email', $email)->first()) {
                return view('register', [
                    'validation' => $validation,
                    'error' => 'Cet email est déjà utilisé.',
                    'currentPage' => 'register'
                ]);
            }

            // ✅ Insérer les données dans `comptes`
            $compteData = [
                'first_name'   => $firstName,
                'last_name'    => $lastName,
                'email'        => $email,
                'password'     => $password,
                'phone_number' => $phoneNumber,
                'etat'         => ($status === 'active') ? 1 : 0, // Utilisation du champ "etat" dans la BDD
            ];
            if (!$compteModel->insert($compteData)) {
                throw new \Exception('Erreur lors de l’insertion dans la table comptes.');
            }

            $compteId = $compteModel->getInsertID();

            // ✅ Insérer les données dans `users`
            $userData = [
                'email'     => $email,
                'password'  => $password,
                'compte_id' => $compteId,
            ];
            if (!$userModel->insert($userData)) {
                throw new \Exception('Erreur lors de l’insertion dans la table users.');
            }

            // ✅ Redirection avec un message de succès
            return redirect()->to('/login')->with('success', 'Inscription réussie. Vous pouvez vous connecter.');

        } catch (\Exception $e) {
            // ✅ Enregistrer l'erreur dans les logs
            log_message('error', $e->getMessage());

            // ✅ Afficher un message d'erreur à l'utilisateur
            return view('register', [
                'error' => 'Une erreur est survenue lors de l’inscription. Veuillez réessayer.',
                'currentPage' => 'register'
            ]);
        }
    }
}
