<?php

namespace App\Models;

use CodeIgniter\Model;

class ReclamationModel extends Model
{
    protected $table = 'reclamations';
    protected $primaryKey = 'reclamation_id';
    protected $allowedFields = ['titre', 'description', 'student_id'];

    public function getAllReclamations()
    {
        return $this->db->table($this->table)
            ->select('reclamations.*, comptes.first_name, comptes.last_name')
            ->join('comptes', 'comptes.compte_id = reclamations.student_id')
            ->get()
            ->getResultArray();
    }
}