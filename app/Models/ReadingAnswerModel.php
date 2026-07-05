<?php

namespace App\Models;

use CodeIgniter\Model;

class ReadingAnswerModel extends Model
{
    protected $table            = 'reading_answers';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'attempt_id',
        'question_id',
        'answer',
        'ai_score',
        'ai_feedback',
    ];
}