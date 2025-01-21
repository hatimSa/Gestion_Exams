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
}