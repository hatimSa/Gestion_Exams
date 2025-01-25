<?php

namespace App\Controllers;

use App\Models\NoteModel;

class EtudNotesController extends BaseController
{
    public function index($student_id)
    {
        $noteModel = new NoteModel();
        $notes = $noteModel->getNotesForStudent($student_id);
        return view('etudNotes', ['notes' => $notes]);
    }
}
