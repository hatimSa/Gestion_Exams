<?php

namespace App\Models;

use CodeIgniter\Model;

class ReclamationModel extends Model
{
    protected $table = 'reclamations';
    protected $primaryKey = 'reclamation_id';
    protected $allowedFields = ['titre', 'description', 'etat', 'student_id'];

    // Récupérer toutes les réclamations avec les informations des utilisateurs
    public function getAllReclamations()
    {
        return $this->db->table($this->table)
            ->select('reclamations.*, comptes.first_name, comptes.last_name')
            ->join('comptes', 'comptes.compte_id = reclamations.student_id')
            ->get()
            ->getResultArray();
    }

    // Récupérer les réclamations des étudiants supervisés par un professeur
    public function getReclamationsByProfessor($professor_id)
    {
        return $this->db->table($this->table)
            ->select('reclamations.*, comptes.first_name, comptes.last_name')
            ->join('comptes', 'comptes.compte_id = reclamations.student_id')
            ->where('comptes.role_id', 1)  // Assure que ce sont des étudiants
            ->where('comptes.compte_id', $professor_id) // Vérifie que l'étudiant est supervisé par le professeur
            ->get()
            ->getResultArray();
    }
}