<?php

namespace App\Models;

use CodeIgniter\Model;

class FiliereModel extends Model
{
    protected $table = 'filieres';
    protected $primaryKey = 'filiere_id';
    protected $allowedFields = ['filiere_name', 'departement_id'];

    public function countAllFilieres()
    {
        return $this->countAllResults();
    }

    public function getAllFilieres()
    {
        return $this->findAll();
    }
}