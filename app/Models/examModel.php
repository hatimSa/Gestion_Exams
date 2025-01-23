<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model
{
    protected $table = 'exams';
    protected $primaryKey = 'exam_id';
    protected $allowedFields = ['module', 'exam_date', 'start_time', 'end_time', 'filiere_id', 'responsable_id', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getExamsByProfessor($responsable_id)
    {
        return $this->where('responsable_id', $responsable_id)->findAll();
    }

    public function getExamsForStudentWithFiliereAndDepartementName($user_id)
    {
        // Récupère le 'filiere_id' de l'utilisateur
        $filiere_id = $this->db->table('comptes')->select('filiere_id')->where('user_id', $user_id)->get()->getRow()->filiere_id;

        // Effectue une jointure pour récupérer les examens avec le nom de la filière et du département
        return $this->db->table('exams')
            ->select('exams.*, filieres.filiere_name, departements.departement_name') // Sélectionne les champs d'examen, le nom de la filière et du département
            ->join('filieres', 'exams.filiere_id = filieres.filiere_id') // Jointure entre exams et filieres
            ->join('departements', 'filieres.departement_id = departements.departement_id') // Jointure entre filieres et departements
            ->where('exams.filiere_id', $filiere_id) // Filtre par filière
            ->get()
            ->getResult();
    }

    public function getUpcomingExams($user_id)
    {
        // Récupère le 'filiere_id' de l'utilisateur
        $filiere_id = $this->db->table('comptes')
        ->select('filiere_id')
        ->where('user_id', $user_id)
            ->get()
            ->getRow()
            ->filiere_id;

        // Filtre les examens en fonction de la filière de l'utilisateur et de la date actuelle
        return $this->db->table('exams')
        ->select('exams.exam_id, exams.module, exams.exam_date') // Sélectionner explicitement les champs nécessaires
        ->where('exams.filiere_id', $filiere_id)
            ->where('exams.exam_date >=', date('Y-m-d'))
            ->orderBy('exams.exam_date', 'ASC')
            ->get()
            ->getResultArray();
    }
}