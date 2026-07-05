<?php

namespace App\Models;

use CodeIgniter\Model;

class ReadingMaterialModel extends Model
{
    protected $table            = 'reading_materials';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'title',
        'topic',
        'level',
        'content',
        'image',
        'estimated_minutes',
        'status',
    ];
}