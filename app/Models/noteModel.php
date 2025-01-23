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

    /**
     * Get notes for a specific exam.
     */
    public function getNotesForExam($exam_id)
    {
        return $this->db->table('comptes')
            ->select('comptes.first_name AS student_name, comptes.last_name, exams.module, notes.note')
            ->join('filieres', 'comptes.filiere_id = filieres.filiere_id')
            ->join('departements', 'filieres.departement_id = departements.departement_id')
            ->join('notes', 'comptes.compte_id = notes.student_id AND notes.exam_id = ' . $this->db->escape($exam_id), 'left')
            ->where('comptes.role_id', 1) // Filtrer par role_id == 1 pour les étudiants
            ->get()
            ->getResultArray();
    }

    /**
     * Get notes associated with exams of the currently logged-in professor.
     */
    public function getNotesForProfessor($prof_id)
    {
        return $this->db->table('notes')
            ->select('comptes.first_name AS student_name, comptes.last_name, exams.module, notes.note')
            ->join('exams', 'notes.exam_id = exams.exam_id')
            ->join('comptes', 'notes.student_id = comptes.compte_id')
            ->where('exams.responsable_id', $prof_id)  // Filtrer par le professeur connecté
            ->orderBy('exams.exam_date', 'DESC') // Optionnel : trier par date d'examen
            ->get()
            ->getResultArray();
    }

    /**
     * Get notes grouped by module for the professor.
     */
    public function getNotesGroupedByModule($prof_id)
    {
        $builder = $this->db->table('notes')
            ->select('notes.*, comptes.first_name, comptes.last_name, exams.module')
            ->join('exams', 'notes.exam_id = exams.exam_id')
            ->join('comptes', 'notes.student_id = comptes.compte_id')
            ->where('exams.responsable_id', $prof_id) // Filtrer par prof connecté
            ->orderBy('exams.module', 'ASC') // Trier par module
            ->get()
            ->getResultArray();

        // Regrouper les notes par module
        $groupedNotes = [];
        foreach ($builder as $note) {
            $groupedNotes[$note['module']][] = $note;
        }

        return $groupedNotes;
    }

    /**
     * Get recent results for a student.
     */
    public function getRecentResults($student_id)
    {
        return $this->db->table('notes')
            ->select('notes.note, notes.exam_id, exams.module, exams.exam_date')
            ->join('exams', 'notes.exam_id = exams.exam_id')
            ->where('notes.student_id', $student_id)
            ->orderBy('notes.note', 'DESC')
            ->limit(5) // Limite à 5 résultats récents
            ->get()
            ->getResult();
    }

    /**
     * Get all results for a specific student.
     */
    public function getStudentResults($student_id)
    {
        return $this->db->table('notes')
            ->select('notes.note, exams.module, exams.exam_date')
            ->join('exams', 'notes.exam_id = exams.exam_id')
            ->where('notes.student_id', $student_id)
            ->get()
            ->getResultArray();
    }

    /**
     * Get student results for the logged-in professor.
     */
    public function getStudentResultsForProfessor($prof_id)
    {
        return $this->db->table('notes')
        ->select("notes.note, notes.exam_id, exams.module, exams.exam_date, CONCAT(comptes.first_name, ' ', comptes.last_name) AS student_name")
        ->join('exams', 'notes.exam_id = exams.exam_id')
        ->join('comptes', 'notes.student_id = comptes.compte_id')
        ->where('exams.responsable_id', $prof_id)
            ->orderBy('notes.note', 'ASC')
            ->limit(3) // Limite à 3 meilleurs résultats
            ->get()
            ->getResult();
    }
}