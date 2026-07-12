<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\VocabularyModel;
use App\Models\PronunciationAttemptModel;
use App\Models\PronunciationAnswerModel;
use App\Services\AnthropicService;

class Pronunciation extends BaseController
{
    protected $vocabularyModel;
    protected $attemptModel;
    protected $answerModel;

    public function __construct()
    {
        $this->vocabularyModel = new VocabularyModel();
        $this->attemptModel    = new PronunciationAttemptModel();
        $this->answerModel     = new PronunciationAnswerModel();
    }

    /**
     * Vocabulary List
     */
    public function index()
    {
        $vocabularies = $this->vocabularyModel
            ->select('
                vocabularies.*,
                
                pronunciation_attempts.completed_at
            ')
            ->join(
                'pronunciation_attempts',
                'pronunciation_attempts.vocabulary_id = vocabularies.id
                 AND pronunciation_attempts.user_id = ' . (int) session('user_id'),
                'left',
                false
            )
            
            ->orderBy('vocabularies.word', 'ASC')
            ->findAll();

        return view('student/pronunciation/index', [
            'title' => 'Pronunciation Practice',
            'vocabularies' => $vocabularies,
        ]);
    }

    /**
     * Start Attempt
     */
    public function start($vocabularyId)
    {

    }

    /**
     * Pronunciation Test
     */
    public function test($attemptId)
    {

    }

    /**
     * Upload Recording & AI Evaluation
     */
    public function saveAnswer()
    {

    }

    /**
     * Feedback
     */
    public function feedback($answerId)
    {

    }

    /**
     * AI Chat
     */
    public function chat()
    {

    }
}