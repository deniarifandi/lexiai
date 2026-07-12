<?php

namespace App\Models;

use CodeIgniter\Model;

class VocabularyModel extends Model
{
    protected $table = 'vocabularies';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'category_id',
        'word',
        'meaning',
        'definition',
        'pronunciation',
        'audio_url',
        'image_url',
        'difficulty'
    ];

    protected $useTimestamps = true;
}