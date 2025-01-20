<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteModel extends Model
{
    protected $table = 'comptes';
    protected $primaryKey = 'compte_id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'phone_number', 'etat', 'user_id', 'role_id'];

    // Fetch all comptes with their corresponding roles
    public function getAllComptesWithRoles()
    {
        return $this->select('comptes.*, roles.role_type')
            ->join('roles', 'roles.role_id = comptes.role_id')
            ->findAll();
    }

    // Fetch a single compte with its role based on compte_id
    public function getCompteWithRole($compte_id)
    {
        return $this->select('comptes.*, roles.role_type')
            ->join('roles', 'roles.role_id = comptes.role_id')
            ->where('compte_id', $compte_id)
            ->first();
    }

    // Fetch the 3 latest student records
    public function getLatestStudents()
    {
        return $this->select('comptes.*, roles.role_type')
            ->join('roles', 'roles.role_id = comptes.role_id')
            ->where('roles.role_type', 'etd')
            ->orderBy('comptes.compte_id', 'DESC')
            ->limit(3)
            ->findAll();
    }

    // Fetch the 3 latest professor records
    public function getLatestProfessors()
    {
        return $this->select('comptes.*, roles.role_type')
            ->join('roles', 'roles.role_id = comptes.role_id')
            ->where('roles.role_type', 'prof')
            ->orderBy('comptes.compte_id', 'DESC')
            ->limit(3)
            ->findAll();
    }
}