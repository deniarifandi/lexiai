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

 
public function reviewPronunciation()
{
    $word      = trim($this->request->getPost('word'));
    $transcript = trim($this->request->getPost('transcript'));

    if ($word === '') {
        return $this->response->setJSON([
            'ok' => false,
            'message' => 'Word is required.',
        ]);
    }

    // Kalau browser gagal capture suara sama sekali
    if ($transcript === '') {
        return $this->response->setJSON([
            'ok' => true,
            'score' => 0,
            'feedback' => 'Tidak ada suara yang terdeteksi. Coba ucapkan kata dengan lebih jelas dan pastikan microphone aktif.',
            'heard_as' => '',
            'tip' => '',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | AI Evaluation
    |--------------------------------------------------------------------------
    */

    $systemPrompt = <<<PROMPT
You are an English pronunciation evaluator for young learners (primary/junior high level).

You will be given:
- The TARGET WORD the student was supposed to say.
- The TRANSCRIPT, which is what the browser's speech recognition engine heard.

IMPORTANT CONTEXT:
The transcript comes from automatic speech recognition, not a perfect audio analysis.
If the transcript matches the target word exactly (case-insensitive), the student
most likely pronounced it correctly enough to be recognized.
If the transcript is a DIFFERENT but similar-sounding word (e.g. "ship" heard as "sheep",
"live" heard as "leave"), explain the likely sound confusion simply.
If the transcript is completely unrelated, assume the recognition failed or the
pronunciation was very unclear.

Score between 0-100:
- 100: transcript matches target word exactly.
- 40-70: transcript is a plausible near-miss (similar sound, likely a specific sound confusion).
- 0-30: transcript is unrelated or empty.

Keep feedback short (1-2 sentences), encouraging, and in Bahasa Indonesia.
Tip must be a short, concrete pronunciation tip in Bahasa Indonesia (e.g. which sound to focus on).

Return ONLY valid JSON in this exact shape:

{
    "score": 0,
    "feedback": "",
    "tip": ""
}
PROMPT;

    $userPrompt = <<<PROMPT
    Target Word:
    {$word}

    Transcript Heard:
    {$transcript}
    PROMPT;

    $ai = new \App\Services\AnthropicService();

    $response = $ai->chat($systemPrompt, [
        [
            'role' => 'user',
            'content' => $userPrompt,
        ]
    ]);

    $response = trim($response);

    if (preg_match('/\{.*\}/s', $response, $matches)) {
        $response = $matches[0];
    }

    $result = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        log_message('error', json_last_error_msg());

        $result = [
            'score' => 0,
            'feedback' => 'Evaluasi gagal, coba lagi.',
            'tip' => '',
        ];
    }

    return $this->response->setJSON([
        'ok' => true,
        'score' => (int) ($result['score'] ?? 0),
        'feedback' => $result['feedback'] ?? '',
        'heard_as' => $transcript,
        'tip' => $result['tip'] ?? '',
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