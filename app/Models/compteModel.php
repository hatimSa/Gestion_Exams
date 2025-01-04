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

    /**
     * Récupérer tous les comptes avec leurs rôles.
     *
     * @return array
     */
    public function getAllComptesWithRoles()
    {
        // Effectuer une jointure avec la table `roles` pour récupérer les rôles
        return $this->select('comptes.*, roles.role_type')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left') // Join pour récupérer le type de rôle
            ->findAll();
    }
}