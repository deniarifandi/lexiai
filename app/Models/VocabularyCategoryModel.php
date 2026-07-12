<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabularyCategoryModel extends Model
{
    protected $table            = 'vocabulary_categories';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'name',
        'description'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]|is_unique[vocabulary_categories.name,id,{id}]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'  => 'Category name is required.',
            'is_unique' => 'Category already exists.',
        ],
    ];
}