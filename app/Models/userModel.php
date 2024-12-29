<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nom de la table dans la base de données
    protected $primaryKey = 'user_id'; // Clé primaire
    protected $allowedFields = ['password', 'email', 'compte_id']; // Champs modifiables
}