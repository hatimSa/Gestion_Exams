<?php

namespace App\Controllers;

use App\Models\ExamModel;

class ExamsAddController extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $currentPage = 'examsAdd';

        return view('examsAdd', ['currentPage' => $currentPage]);
    }

    public function store()
    {
        $examModel = new ExamModel();

        $data = [
            'exam_name' => $this->request->getPost('exam_name'),
            'exam_date' => $this->request->getPost('exam_date'),
        ];

        if (!$examModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $examModel->errors());
        }

        return redirect()->to('/manage-exams')->with('success', 'Exam ajouté avec succès');
    }
}