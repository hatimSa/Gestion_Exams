<?php

// App\Controllers\ExamsListController.php
namespace App\Controllers;

use App\Models\DepartementModel;
use App\Models\ExamModel;
use App\Models\FiliereModel;
use App\Models\NoteModel;

class ExamsListController extends BaseController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Récupérer l'ID du professeur connecté
        $responsable_id = session()->get('user_id');

        // Charger le modèle
        $examModel = new ExamModel();

        // Récupérer la liste des exams pour ce professeur avec les noms des filières et des départements
        $exams = $examModel->select('exams.*, filieres.filiere_name, departements.departement_name')
            ->join('filieres', 'exams.filiere_id = filieres.filiere_id')
            ->join('departements', 'filieres.departement_id = departements.departement_id')
            ->where('exams.responsable_id', $responsable_id)  // Filtrage par responsable_id
            ->findAll();

        // Définir la variable currentPage
        $currentPage = 'examsList';

        // Passer les données et la page actuelle à la vue
        return view('examsList', [
            'exams' => $exams,
            'currentPage' => $currentPage,
        ]);
    }

    public function edit($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Charger les modèles nécessaires
        $examModel = new ExamModel();
        $departementModel = new DepartementModel();
        $filiereModel = new FiliereModel();

        // Récupérer l'utilisateur connecté
        $user_id = session()->get('user_id');
        $userModel = new \App\Models\CompteModel(); // Le modèle Compte avec `departement_id` et `filiere_id`
        $user = $userModel->find($user_id);

        // Récupérer le département et la filière du professeur
        $departement_id = $user['departement_id'];
        $filiere_id = $user['filiere_id'];

        // Filtrer les départements et les filières
        $departements = $departementModel->where('departement_id', $departement_id)->findAll();
        $filieres = $filiereModel->where('filiere_id', $filiere_id)->findAll();

        // Récupérer les informations de l'examen à modifier
        $exam = $examModel->find($id);
        if (!$exam) {
            return redirect()->to('/examsList')->with('error', 'Examen introuvable.');
        }

        // Passer les données à la vue
        $currentPage = 'examsEdit';
        return view('examsEdit', [
            'currentPage' => $currentPage,
            'exam' => $exam,
            'departements' => $departements,
            'filieres' => $filieres,
        ]);
    }

    public function update($id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour modifier un examen.');
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
        ];

        // Mettre à jour l'examen dans la base de données
        if (!$examModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $examModel->errors());
        }

        // Rediriger vers la liste des examens avec un message de succès
        return redirect()->to('/examsList')->with('success', 'Examen modifié avec succès.');
    }

    public function delete($id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $examModel = new ExamModel();

        if ($examModel->delete($id)) {
            return redirect()->to('/examsList')->with('success', 'Examen supprimé avec succès');
        }

        return redirect()->to('/examsList')->with('error', 'Erreur lors de la suppression');
    }

    public function noter($exam_id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Charger les modèles nécessaires
        $examModel = new ExamModel();
        $noteModel = new NoteModel();
        $compteModel = new \App\Models\CompteModel(); // Modèle pour les étudiants

        // Récupérer les informations de l'examen
        $exam = $examModel->find($exam_id);
        if (!$exam) {
            return redirect()->to('/examsList')->with('error', 'Examen introuvable.');
        }

        // Récupérer les étudiants de la filière associée à cet examen
        $students = $compteModel->select('comptes.compte_id, comptes.first_name AS first_name, comptes.last_name AS last_name, filieres.filiere_name AS filiere, departements.departement_name AS departement')
        ->join('filieres', 'comptes.filiere_id = filieres.filiere_id')
        ->join('departements', 'filieres.departement_id = departements.departement_id')
        ->where('comptes.filiere_id', $exam['filiere_id'])
        ->findAll();

        // Récupérer les notes existantes pour cet examen
        $notes = $noteModel->select('notes.*, comptes.first_name AS first_name, comptes.last_name AS last_name, filieres.filiere_name AS filiere, departements.departement_name AS departement')
        ->join('comptes', 'notes.student_id = comptes.compte_id')
        ->join('filieres', 'comptes.filiere_id = filieres.filiere_id')
        ->join('departements', 'filieres.departement_id = departements.departement_id')
        ->where('notes.exam_id', $exam_id)
            ->findAll();

        // Passer les données à la vue
        return view('notesList', [
            'exam' => $exam,
            'students' => $students,
            'notes' => $notes, // Ajouter les notes à la vue
            'currentPage' => 'notesList',
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}