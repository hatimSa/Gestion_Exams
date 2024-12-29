<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password'];
    protected $useTimestamps = true;

    // Validation des données
    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
    ];

    // Messages d'erreur personnalisés
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered.',
        ],
        'password' => [
            'min_length' => 'Password must be at least 8 characters long.',
        ],
    ];
}