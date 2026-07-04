<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'is_active',
        'last_login',
    ];

    protected $useTimestamps = true;
}