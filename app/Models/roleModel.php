<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $allowedFields = ['role_type'];

    public function getRoleIdByType($role_type)
    {
        return $this->where('role_type', $role_type)->first();
    }
}
