<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['email', 'password', 'compte_id', 'user_id'];

    // Pour gérer les timestamps (si tes tables les supportent)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Récupérer un utilisateur avec ses informations de compte
    public function getUserWithCompte($userId)
    {
        return $this->select('users.*, comptes.first_name, comptes.last_name, comptes.email as compte_email')
            ->join('comptes', 'comptes.compte_id = users.compte_id', 'left')
            ->where('users.user_id', $userId)
            ->first();
    }

    // Ajouter une méthode de validation pour les données d'utilisateur
    public function validateUserData($data)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ]);

        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        return true;
    }
}