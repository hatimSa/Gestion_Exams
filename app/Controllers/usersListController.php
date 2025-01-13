<?php

namespace App\Controllers;

use App\Models\CompteModel;

class UsersListController extends BaseController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            // Si non connecté, rediriger vers la page de connexion
            return redirect()->to('/login');
        }
    
        // Récupérer les informations de l'utilisateur depuis la session
        $user_id = session()->get('user_id');
    
        // Charger le modèle
        $compteModel = new CompteModel();
    
        // Récupérer les données du compte de l'utilisateur
        $compte = $compteModel->find($user_id);
    
        // Vérifier si le compte existe
        if ($compte === null) {
            // Si le compte n'existe pas, rediriger vers une autre page avec un message d'erreur
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }
    
        // Vérifier si le role_id est égal à 3 (admin)
        if ($compte['role_id'] != 3) {
            // Si le role_id n'est pas 3, rediriger vers une autre page (par exemple, page d'accueil)
            return redirect()->to('/home');
        }
    
        // Récupérer les comptes avec leurs rôles
        $comptes = $compteModel->getAllComptesWithRoles();
    
        // Ajouter la variable $currentPage pour identifier la page active
        $currentPage = 'usersList';
    
        // Passer les données et la page actuelle à la vue
        return view('usersList', [
            'comptes' => $comptes,
            'currentPage' => $currentPage,
        ]);
    }

    public function edit($compte_id)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $compteModel = new CompteModel();
        $compte = $compteModel->getCompteWithRole($compte_id);

        // Debugging: Check if data is being fetched
        log_message('debug', 'Editing Compte: ' . print_r($compte, true));

        if (!$compte) {
            return redirect()->to('/usersList')->with('error', 'Utilisateur non trouvé.');
        }

        return view('usersEdit', [
            'compte' => $compte,
            'currentPage' => 'usersEdit',
        ]);
    }


    public function update($compte_id)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $compteModel = new CompteModel();
        $compte = $compteModel->find($compte_id);

        if (!$compte) {
            return redirect()->to('/usersList')->with('error', 'Utilisateur non trouvé.');
        }

        // Prepare the data for update
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'phone_number'      => $this->request->getPost('phone_number'),
            'etat'       => $this->request->getPost('etat'),
            // You need to update role_id based on role_type, not directly role_type
            'role_id'    => $this->getRoleIdFromType($this->request->getPost('role_type')),
        ];

        // Update the compte record with new data
        $compteModel->update($compte_id, $data);

        return redirect()->to('/usersList')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Helper method to map role_type to role_id
    private function getRoleIdFromType($role_type)
    {
        $roleModel = new \App\Models\RoleModel(); // Assuming you have a RoleModel for the roles table
        $role = $roleModel->where('role_type', $role_type)->first();

        return $role ? $role['role_id'] : null; // Return role_id for the given role_type
    }

    public function details($id)
    {
        // Charger le modèle
        $compteModel = new CompteModel();

        // Trouver l'utilisateur par ID
        $compte = $compteModel->find($id);

        if (!$compte) {
            return 'Utilisateur introuvable';
        }

        // Définir la variable currentPage
        $currentPage = 'usersList';

        // Retourner la vue des détails de l'utilisateur
        return view('userDetails', [
            'compte' => $compte,
            'currentPage' => $currentPage,  // Passer la variable currentPage à la vue
        ]);
    }

    public function delete($id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Charger le modèle
        $compteModel = new CompteModel();

        // Vérifier si le compte existe
        $compte = $compteModel->find($id);

        // Si le compte n'existe pas, rediriger avec un message d'erreur
        if (!$compte) {
            return redirect()->to('/usersList')->with('error', 'Compte introuvable.');
        }

        // Charger le modèle pour la table `users`
        $db = \Config\Database::connect();
        $userModel = $db->table('users');

        // Supprimer l'utilisateur dans la table `users` lié au compte
        $userDeleted = $userModel->where('compte_id', $id)->delete();

        // Supprimer le compte dans la table `comptes`
        $compteDeleted = $compteModel->delete($id);

        // Vérifier si les deux suppressions ont réussi
        if ($userDeleted && $compteDeleted) {
            // Rediriger avec un message de succès
            return redirect()->to('/usersList')->with('success', 'Compte et utilisateur supprimés avec succès.');
        } else {
            // Rediriger avec un message d'erreur en cas d'échec de suppression
            return redirect()->to('/usersList')->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}