<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteModel extends Model
{
    protected $table = 'comptes';
    protected $primaryKey = 'compte_id';
    protected $allowedFields = [
<<<<<<< HEAD
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'etat',
        'user_id',
        'role_id'
    ]; // Columns in the comptes table
}
=======
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'phone_number', 
        'etat', 
        'user_id', 
        'role_id'
    ]; // Columns in the `comptes` table
}
>>>>>>> 363dca957c628133bcac990c7a19dd1ac0e9475a
