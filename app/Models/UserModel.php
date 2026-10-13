<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $useTimestamps    = true;
    protected $createdField      = 'created_at';
    protected $updatedField      = 'updated_at';

protected $allowedFields = [
'name', 'email', 'password', 'active', 'is_admin',
'profile_image', 'activation_token', 'activation_expires',
'reset_token', 'reset_expires', 'remember_token',
];

protected $validationRules = [
'name' => 'required|min_length[3]|max_length[100]',
'email' => 'required|valid_email|max_length[150]|is_unique[users.email,id,{id}]',
];

protected $skipValidation = false;
}
