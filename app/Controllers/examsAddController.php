<?php

namespace App\Controllers;

use App\Models\ExamModel;
use App\Models\DepartementModel;
use App\Models\FiliereModel;
use App\Models\CompteModel;
use App\Models\NoteModel;

class ExamsAddController extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Charger les modèles nécessaires
        $departementModel = new DepartementModel();
        $filiereModel = new FiliereModel();
        $compteModel = new CompteModel();

        // Récupérer l'utilisateur connecté
        $user_id = session()->get('user_id');

        // Récupérer les informations du compte
        $compte = $compteModel->where('user_id', $user_id)->first();

        if (!$compte) {
            return redirect()->to('/login')->with('error', 'Compte non trouvé.');
        }

        // Récupérer le département et la filière du compte
        $departement_id = $compte['departement_id'];
        $filiere_id = $compte['filiere_id'];

        // Filtrer les départements et les filières en fonction du compte
        $departements = $departementModel->where('departement_id', $departement_id)->findAll();
        $filieres = $filiereModel->where('filiere_id', $filiere_id)->findAll();

        // Passer les données à la vue
        $currentPage = 'examsAdd';
        return view('examsAdd', [
            'currentPage' => $currentPage,
            'departements' => $departements,
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

        // Récupérer les modèles nécessaires
        $examModel = new ExamModel();
        $compteModel = new CompteModel();
        $notesModel = new \App\Models\NoteModel(); // Assurez-vous que le modèle existe

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

        // Récupérer l'ID de l'examen ajouté
        $exam_id = $examModel->getInsertID();

        // Récupérer les étudiants avec role_id == 1 et appartenant à la même filière
        $filiere_id = $data['filiere_id'];
        $students = $compteModel->where('filiere_id', $filiere_id)
            ->where('role_id', 1) // Filtrer par role_id == 1
            ->findAll();

        // Insérer une ligne dans la table notes pour chaque étudiant
        foreach ($students as $student) {
            $noteData = [
                'student_id' => $student['user_id'], // Récupérer l'ID de l'étudiant
                'exam_id' => $exam_id,
            ];
            $notesModel->save($noteData);
        }

        // Rediriger vers la liste des examens avec un message de succès
        return redirect()->to('/examsList')->with('success', 'Exam ajouté avec succès et notes initialisées.');
    }
}