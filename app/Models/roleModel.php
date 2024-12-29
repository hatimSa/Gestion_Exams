<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'role_id';

    protected $allowedFields = ['role_type'];

    protected $returnType = 'object';
}