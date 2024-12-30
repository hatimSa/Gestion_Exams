<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Simulate user session retrieval (e.g., user_id from session)
        $session = session();
        $userId = $session->get('user_id'); // Ensure user_id is set during login
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        // Fetch user data
        $compteModel = new CompteModel();
        $user = $compteModel->where('user_id', $userId)->first();

        // Check if user exists
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        // Pass user data to the dashboard view
        return view('dashboard', ['user' => $user]);
    }
}
