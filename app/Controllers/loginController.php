<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompteModel;

class LoginController extends BaseController
{
    /**
     * Display the login form.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Handle user login.
     */
    public function login()
    {
        // Retrieve form data and trim it to remove any leading/trailing spaces
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        // Ensure email and password are provided
        if (!$email || !$password) {
            session()->setFlashdata('error', 'Email and password are required.');
            return redirect()->to('/login')->withInput();
        }

        // Load models
        $userModel = new UserModel();
        $compteModel = new CompteModel();

        // Log input data for debugging purposes
        log_message('debug', "Login attempt with email: $email");

        // Fetch user from the 'users' table
        $user = $userModel->where('email', $email)->first();

        // Log the result of the query for debugging
        log_message('debug', "User fetched: " . print_r($user, true));

        if ($user) {
            // Check password validity
            if (password_verify($password, $user['password'])) {
                // Fetch user profile from 'comptes' table using compte_id
                $compte = $compteModel->where('compte_id', $user['compte_id'])->first();

                // Store session data
                session()->set([
                    'user_id' => $user['user_id'],
                    'email' => $user['email'],
                    'first_name' => $compte['first_name'] ?? null,
                    'last_name' => $compte['last_name'] ?? null,
                ]);

                // Redirect to the dashboard
                return redirect()->to('/dashboard');
            } else {
                // Incorrect password
                session()->setFlashdata('error', 'Invalid password.');
                return redirect()->to('/login')->withInput();
            }
        } else {
            // User not found
            log_message('error', "User not found with email: $email");
            session()->setFlashdata('error', 'No user found with that email.');
            return redirect()->to('/login')->withInput();
        }
    }

    /**
     * Log out the user.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
