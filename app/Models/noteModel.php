<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'note_id';
    protected $allowedFields = ['student_id', 'exam_id', 'note'];

    /**
     * Fetch notes with student, department, and filiere details.
     */
    public function getNotesWithDetails()
    {
        return $this->select('notes.*, comptes.first_name, comptes.last_name, filieres.filiere_name AS filiere, departements.departement_name AS departement')
        ->join('comptes', 'notes.student_id = comptes.compte_id')
        ->join('filieres', 'comptes.filiere_id = filieres.filiere_id')
        ->join('departements', 'filieres.departement_id = departements.departement_id')
        ->findAll();
    }

    public function getNotesForExam($exam_id)
    {
        return $this->db->table('comptes')
        ->select('comptes.compte_id AS student_id, comptes.first_name, comptes.last_name, filieres.filiere_name AS filiere_name, departements.departement_name AS departement_name, notes.note_id, notes.note')
        ->join('filieres', 'comptes.filiere_id = filieres.filiere_id')
        ->join('departements', 'filieres.departement_id = departements.departement_id')
        ->join('notes', 'comptes.compte_id = notes.student_id AND notes.exam_id = ' . $this->db->escape($exam_id), 'left')
        ->where('comptes.role_id', 1) // Ajouter le filtrage par role_id == 1 pour les étudiants
            ->where('filieres.filiere_id', function ($builder) use ($exam_id) {
                $builder->select('exams.filiere_id')
                ->from('exams')
                ->where('exams.exam_id', $exam_id)
                    ->limit(1);
            })
            ->get()
            ->getResultArray();
    }
}