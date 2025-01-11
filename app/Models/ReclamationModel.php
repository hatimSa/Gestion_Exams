<?php

namespace App\Models;

use CodeIgniter\Model;

class ReclamationModel extends Model
{
    protected $table = 'reclamations'; // Ensure this matches your database table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'objet', 'message'];
}
