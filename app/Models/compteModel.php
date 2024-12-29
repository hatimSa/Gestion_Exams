<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteModel extends Model
{
    protected $table      = 'comptes'; // Nom de la table
    protected $primaryKey = 'compte_id'; // Clé primaire de la table

    // Définir les colonnes qui peuvent être mises à jour
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'phone_number', 'etat', 'user_id', 'role_id'];

    // Définir les règles de validation
    protected $validationRules = [
        'email'    => 'required|valid_email|is_unique[comptes.email]',
        'password' => 'required|min_length[8]',
    ];

    // Définir les erreurs de validation personnalisées
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Cet email est déjà utilisé.',
        ],
    ];

    // Retourner les résultats sous forme d'objets
    protected $returnType = 'object';

    // Permet de hacher le mot de passe avant d'enregistrer dans la base de données
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Méthode pour hasher le mot de passe
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}