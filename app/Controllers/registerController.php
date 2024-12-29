<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function attemptRegister()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|matches[passconf]',
            'passconf' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('register', [
                'validation' => $this->validator,
            ]);
        }

        $userModel = model('UserModel');
        $userModel->insert([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login');
    }
}