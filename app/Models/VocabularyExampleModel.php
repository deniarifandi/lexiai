<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabularyExampleModel extends Model
{
    protected $table            = 'vocabulary_examples';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'vocabulary_id',
        'sentence',
        'translation',
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'vocabulary_id' => 'required|integer',
        'sentence'      => 'required|min_length[5]',
        'translation'   => 'permit_empty',
    ];

    protected $validationMessages = [
        'sentence' => [
            'required'   => 'Example sentence is required.',
            'min_length' => 'Example sentence is too short.',
        ],
    ];
}