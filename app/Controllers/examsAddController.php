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

        // Charger les filières de manière similaire si nécessaire
        $filiereModel = new \App\Models\FiliereModel();
        $filieres = $filiereModel->findAll();

        // Passer les données à la vue
        $currentPage = 'examsAdd';
        return view('examsAdd', [
            'currentPage' => $currentPage,
            'filieres' => $filieres
        ]);
    }


    public function store()
    {
        // Récupérer l'ID de l'utilisateur connecté depuis la session
        $user_id = session()->get('user_id');

        // Vérifier si l'utilisateur est connecté
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour ajouter un examen');
        }

        // Récupérer le modèle Exam
        $examModel = new ExamModel();

        // Récupérer les données du formulaire
        $data = [
            'module' => $this->request->getPost('module'),
            'exam_date' => $this->request->getPost('exam_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'filiere_id' => $this->request->getPost('filiere_id'),
            'responsable_id' => $user_id, // Utiliser l'ID de l'utilisateur connecté
        ];

        // Sauvegarder l'examen dans la base de données
        if (!$examModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $examModel->errors());
        }

        // Rediriger vers la liste des examens avec un message de succès
        return redirect()->to('/examsList')->with('success', 'Exam ajouté avec succès');
    }
}