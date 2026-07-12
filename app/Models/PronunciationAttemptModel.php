<?php

namespace App\Models;

use CodeIgniter\Model;

class PronunciationAttemptModel extends Model
{
    protected $table            = 'pronunciation_attempts';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'user_id',
        'vocabulary_id',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}