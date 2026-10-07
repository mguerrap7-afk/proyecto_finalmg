<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
protected $table            = 'tasks';
protected $primaryKey       = 'id';
protected $returnType       = 'array';
protected $useAutoIncrement = true;
protected $useTimestamps    = true;
protected $createdField     = 'created_at';
protected $updatedField     = 'updated_at';

protected $allowedFields = ['user_id', 'description'];

protected $validationRules = [
'description' => 'required|min_length[3]|max_length[1000]',
];

protected $skipValidation = false;
}
