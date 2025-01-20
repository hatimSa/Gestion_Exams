<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartementModel extends Model
{
    protected $table = 'departements';
    protected $primaryKey = 'departement_id';
    protected $allowedFields = ['departement_name'];

    public function countAllDepartements()
    {
        return $this->countAllResults();
    }
}