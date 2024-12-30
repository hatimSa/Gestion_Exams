<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
<<<<<<< HEAD
    protected $allowedFields = ['email', 'password', 'compte_id']; // Columns in the users table
}
=======
    protected $allowedFields = ['email', 'password', 'compte_id']; // Columns in the `users` table
}
>>>>>>> 363dca957c628133bcac990c7a19dd1ac0e9475a
