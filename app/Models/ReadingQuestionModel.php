<?php

namespace App\Models;

use CodeIgniter\Model;

class ReadingQuestionModel extends Model
{
    protected $table = 'reading_questions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'material_id',
        'question',
        'reference_answer',
        'keywords',
        'order_number'
    ];
}