<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabularyAttemptModel extends Model
{
    protected $table = 'vocabulary_attempts';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'vocabulary_id',
        'started_at',
        'completed_at',
    ];

    protected $useTimestamps = false;
}