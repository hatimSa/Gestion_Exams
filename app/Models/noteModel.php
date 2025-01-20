<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'note_id';
    protected $allowedFields = ['student_id', 'exam_id', 'note'];
}
