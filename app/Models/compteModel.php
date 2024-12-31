<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteModel extends Model
{
    protected $table = 'comptes';
    protected $primaryKey = 'compte_id';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'etat',
        'user_id',
        'role_id'
    ]; // Columns in the comptes table

    public function getAllComptesWithRoles()
    {
        // Effectuer une jointure avec la table `roles` pour récupérer les rôles
        return $this->select('comptes.*, roles.role_type')
        ->join('roles', 'roles.role_id = comptes.role_id', 'left') // Join pour récupérer le type de rôle
        ->findAll();
    }
}