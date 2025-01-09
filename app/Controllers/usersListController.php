<?php

namespace App\Controllers;

use App\Models\CompteModel;

class UsersListController extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $user_id = session()->get('user_id');
        $compteModel = new CompteModel();
        $compte = $compteModel->find($user_id);

        if ($compte['role_id'] != 3) {
            return redirect()->to('/home');
        }

        // Get all comptes with the role_type by joining the roles table
        $comptes = $compteModel->getAllComptesWithRoles();

        return view('usersList', [
            'comptes' => $comptes,
            'currentPage' => 'usersList', // Properly define currentPage
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
}
