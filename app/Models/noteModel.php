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
}