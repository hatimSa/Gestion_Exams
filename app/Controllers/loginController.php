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
    }
}
