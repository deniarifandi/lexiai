<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabularyExerciseModel extends Model
{
    protected $table = 'vocabulary_exercises';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'vocabulary_id',
        'question',
        'expected_answer',
        'difficulty',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'vocabulary_id' => 'required|integer',
        'question' => 'required|min_length[10]',
    ];
}