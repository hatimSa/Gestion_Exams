<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteModel extends Model
{
    protected $table = 'comptes';
    protected $primaryKey = 'compte_id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'phone_number', 'etat', 'user_id', 'role_id', 'departement_id', 'filiere_id'];

    // Fetch all comptes with their corresponding roles, departments, and filieres
    public function getAllComptesWithRoles()
    {
        return $this->select('comptes.*, roles.role_type, departements.departement_name, filieres.filiere_name')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left')
            ->join('departements', 'departements.departement_id = comptes.departement_id', 'left') // Correction pour departements
            ->join('filieres', 'filieres.filiere_id = comptes.filiere_id', 'left') // Correction pour filieres
            ->findAll();
    }

    // Fetch a single compte with its role, department, and filiere based on compte_id
    public function getCompteWithRole($compte_id)
    {
        return $this->select('comptes.*, roles.role_type, departements.departement_name, filieres.filiere_name')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left')
            ->join('departements', 'departements.departement_id = comptes.departement_id', 'left') // Correction pour departements
            ->join('filieres', 'filieres.filiere_id = comptes.filiere_id', 'left') // Correction pour filieres
            ->where('comptes.compte_id', $compte_id)
            ->first();
    }

    // Count the number of comptes by role type
    public function countByRole($role_type)
    {
        return $this->join('roles', 'roles.role_id = comptes.role_id')
            ->where('roles.role_type', $role_type)
            ->countAllResults();
    }

    // Count all comptes
    public function countAll()
    {
        return $this->countAllResults();
    }

    // Fetch the 3 latest student records
    public function getLatestStudents()
    {
        return $this->select('comptes.*, roles.role_type, departements.departement_name, filieres.filiere_name')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left')
            ->join('departements', 'departements.departement_id = comptes.departement_id', 'left') // Correction pour departements
            ->join('filieres', 'filieres.filiere_id = comptes.filiere_id', 'left') // Correction pour filieres
            ->where('roles.role_type', 'etd')
            ->orderBy('comptes.compte_id', 'DESC')
            ->limit(3)
            ->findAll();
    }

    // Fetch the 3 latest professor records
    public function getLatestProfessors()
    {
        return $this->select('comptes.*, roles.role_type, departements.departement_name, filieres.filiere_name')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left')
            ->join('departements', 'departements.departement_id = comptes.departement_id', 'left') // Correction pour departements
            ->join('filieres', 'filieres.filiere_id = comptes.filiere_id', 'left') // Correction pour filieres
            ->where('roles.role_type', 'prof')
            ->orderBy('comptes.compte_id', 'DESC')
            ->limit(3)
            ->findAll();
    }

    public function getStudentByFiliere($filiere_id)
    {
        return $this->select('comptes.*, roles.role_type, departements.departement_name, filieres.filiere_name')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left')
            ->join('departements', 'departements.departement_id = comptes.departement_id', 'left') // Correction pour departements
            ->join('filieres', 'filieres.filiere_id = comptes.filiere_id', 'left') // Correction pour filieres
            ->where('roles.role_type', 'etd')
            ->where('filieres.filiere_id', $filiere_id)
            ->findAll();
    }
}