<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login'); // Charge la vue login.php
    }

    public function attemptLogin()
    {
        // Logique de traitement du login
        $session = session();

        $model = model('UserModel');
        $email = $this->request->getVar('Email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if (!$user) {
            $session->setFlashdata('msg', 'Email ou mot de passe incorrect');
            return redirect()->to('/login');
        }

        $passHash = $user['password'];

        if (password_verify($password, $passHash)) {
            $session->set('loggedUser', $user);
            return redirect()->to('/home');
        }

        $session->setFlashdata('msg', 'Email ou mot de passe incorrect');
        return redirect()->to('/login');
    }
}
