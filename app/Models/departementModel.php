<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartementModel extends Model
{
    protected $table = 'departements';
    protected $primaryKey = 'departement_id';
    protected $allowedFields = ['departement_name'];

    // Fonction pour compter tous les départements
    public function countAllDepartements()
    {
        return $this->countAllResults();
    }

    // Fonction pour récupérer tous les départements
    public function getAllDepartements()
    {
        return $this->findAll(); // Récupère tous les départements
    }
}