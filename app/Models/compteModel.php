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
        'role_id',
        'user_id'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at'; // Si tu as une colonne pour la date de création
    protected $updatedField  = 'updated_at'; // Si tu as une colonne pour la date de mise à jour

    // Récupérer tous les comptes avec les rôles associés
    public function getAllComptesWithRoles($status = null)
    {
        $builder = $this->select('comptes.*, roles.role_type')
            ->join('roles', 'roles.role_id = comptes.role_id', 'left'); // Join pour récupérer le type de rôle

        // Ajouter un filtre sur le statut si fourni
        if ($status) {
            $builder->where('comptes.etat', $status);
        }

        return $builder->findAll();
    }
}