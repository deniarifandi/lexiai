<?php

namespace App\Models;

use CodeIgniter\Model;

class PronunciationAnswerModel extends Model
{
    protected $table            = 'pronunciation_answers';
    protected $primaryKey       = 'id';

    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'attempt_id',
        'audio_file',
        'transcript',
        'ai_score',
        'ai_feedback',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}