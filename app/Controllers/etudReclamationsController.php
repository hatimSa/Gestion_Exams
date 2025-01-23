<?php

namespace App\Controllers;

use App\Models\ReclamationModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class EtudReclamationsController extends Controller
{
    private function isAuthorized()
    {
        if (!session()->has('user_id')) {
            return false;
        }

        $user_id = session()->get('user_id');
        $compteModel = new CompteModel();
        $compte = $compteModel->find($user_id);

        return $compte && $compte['role_id'] == 1;
    }

    public function index()
    {
        if (!$this->isAuthorized()) {
            return redirect()->to('/login');
        }

        $user_id = session()->get('user_id');
        $reclamationModel = new ReclamationModel();
        $reclamations = $reclamationModel->where('student_id', $user_id)->findAll();

        return view('etudReclamations', [
            'currentPage' => 'etudReclamations',
            'reclamations' => $reclamations,
            'success' => session()->getFlashdata('success'),
            'errors' => session()->getFlashdata('errors'),
        ]);
    }

    public function store()
    {
        if (!$this->isAuthorized()) {
            return redirect()->to('/login');
        }

        // Validation des données du formulaire
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'titre' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $reclamationModel = new ReclamationModel();

            $reclamation_id = $this->request->getPost('reclamation_id'); // ID de la réclamation, pour la mise à jour

            // Si un ID est fourni, il s'agit d'une modification
            if ($reclamation_id) {
                // Mettre à jour la réclamation existante
                $reclamationModel->update($reclamation_id, [
                    'titre' => $this->request->getPost('titre'),
                    'description' => $this->request->getPost('description'),
                ]);
                $message = 'Réclamation modifiée avec succès!';
            } else {
                // Ajouter une nouvelle réclamation
                $reclamationModel->save([
                    'titre' => $this->request->getPost('titre'),
                    'description' => $this->request->getPost('description'),
                    'student_id' => session()->get('user_id'),
                ]);
                $message = 'Réclamation ajoutée avec succès!';
            }

            // Redirection avec message de succès
            return redirect()->to('/etudReclamations')->with('success', $message);
        } catch (\Throwable $e) {
            log_message('error', '[STORE ERROR] ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur inattendue est survenue.');
        }
    }

    public function delete()
    {
        if (!$this->isAuthorized()) {
            return redirect()->to('/login');
        }

        $reclamation_id = $this->request->getPost('reclamation_id');

        try {
            $reclamationModel = new ReclamationModel();
            $reclamation = $reclamationModel->find($reclamation_id);

            if (!$reclamation || $reclamation['student_id'] !== session()->get('user_id')) {
                return redirect()->to('/etudReclamations')->with('error', 'Réclamation introuvable ou non autorisée.');
            }

            $reclamationModel->delete($reclamation_id);
            return redirect()->to('/etudReclamations')->with('success', 'Réclamation supprimée avec succès.');
        } catch (\Throwable $e) {
            log_message('error', '[DELETE ERROR] ' . $e->getMessage());
            return redirect()->to('/etudReclamations')->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
