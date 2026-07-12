<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabularyAnswerModel extends Model
{
    protected $table = 'vocabulary_answers';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'attempt_id',
        'answer',
        'score',
        'ai_feedback',
        'ai_suggestion',
        'created_at',
    ];

    protected $useTimestamps = false;
}