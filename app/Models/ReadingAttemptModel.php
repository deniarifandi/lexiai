<?php

namespace App\Models;

use CodeIgniter\Model;

class ReadingAttemptModel extends Model
{
    protected $table            = 'reading_attempts';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'user_id',
        'material_id',
        'status',
        'started_at',
        'submitted_at',
        'completed_at',
        'total_score',
    ];
}