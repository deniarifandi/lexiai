<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\VocabularyModel;
use App\Models\VocabularyExerciseModel;
use App\Models\VocabularyExampleModel;
use App\Models\VocabularyAttemptModel;
use App\Models\VocabularyAnswerModel;
use App\Services\AnthropicService;

class Vocabulary extends BaseController
{
    protected $vocabularyModel;
    protected $exerciseModel;
    protected $exampleModel;
    protected $attemptModel;
    protected $answerModel;

    public function __construct()
    {
        $this->vocabularyModel = new VocabularyModel();
        $this->exerciseModel  = new VocabularyExerciseModel();
        $this->exampleModel   = new VocabularyExampleModel();
        $this->attemptModel   = new VocabularyAttemptModel();
        $this->answerModel    = new VocabularyAnswerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Vocabulary',
            'vocabularies' => $this->vocabularyModel
                ->orderBy('word', 'ASC')
                ->findAll(),
        ];

        return view('student/vocabulary/index', $data);
    }

    public function start($id)
    {
        $userId     = session()->get('user_id');
        $attemptId = $this->attemptModel->insert([
            'user_id'       => $userId,
            'vocabulary_id' => $id,
            'started_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('student/vocabulary/test/' . $attemptId);
    }

    public function test($attemptId)
    {
        $attempt = $this->attemptModel->find($attemptId);

        if (!$attempt) {
            return redirect()->to('student/vocabulary');
        }

        $vocabulary = $this->vocabularyModel->find($attempt['vocabulary_id']);

        $exercise = $this->exerciseModel
            ->where('vocabulary_id', $vocabulary['id'])
            ->first();

        $example = $this->exampleModel
            ->where('vocabulary_id', $vocabulary['id'])
            ->first();

        return view('student/vocabulary/test', [
            'title'      => 'Vocabulary Exercise',
            'attempt'    => $attempt,
            'vocabulary' => $vocabulary,
            'exercise'   => $exercise,
            'example'    => $example,
        ]);
    }

    // public function saveAnswer()
    // {
    //     $attemptId = $this->request->getPost('attempt_id');

    //     $this->answerModel->insert([
    //         'attempt_id' => $attemptId,
    //         'answer'     => $this->request->getPost('answer'),
    //     ]);

    //     // TODO:
    //     // Call AI
    //     // Save score
    //     // Save feedback

    //     return redirect()->to('student/vocabulary/feedback/' . $attemptId);
    // }

    // public function feedback($attemptId)
    // {
    //     $attempt = $this->attemptModel->find($attemptId);

    //     $answer = $this->answerModel
    //         ->where('attempt_id', $attemptId)
    //         ->first();

    //     $vocabulary = $this->vocabularyModel
    //         ->find($attempt['vocabulary_id']);

    //     return view('student/vocabulary/feedback', [
    //         'title'      => 'Vocabulary Feedback',
    //         'attempt'    => $attempt,
    //         'answer'     => $answer,
    //         'vocabulary' => $vocabulary,
    //     ]);
    // }

    public function saveAnswer()
{
    $userId     = session()->get('user_id');
    $attemptId = $this->request->getPost('attempt_id');
    $sentence  = trim($this->request->getPost('answer'));

    $attempt = $this->attemptModel->find($attemptId);

    if (!$attempt) {
        return redirect()->to('student/vocabulary')
            ->with('error', 'Attempt not found.');
    }

    $vocabulary = $this->vocabularyModel->find($attempt['vocabulary_id']);

    $exercise = $this->exerciseModel
        ->where('vocabulary_id', $vocabulary['id'])
        ->first();

    /*
    |--------------------------------------------------------------------------
    | AI Evaluation
    |--------------------------------------------------------------------------
    */

  $systemPrompt = <<<PROMPT
You are a strict English Vocabulary evaluator.

The student MUST write exactly ONE sentence in ENGLISH using the target vocabulary.

CRITICAL RULES (MANDATORY):

1. If the answer is not predominantly English, you MUST reject it.
2. If the answer is written mostly in Indonesian or any language other than English:
   - score MUST be 0.
   - strengths MUST be [].
   - suggested_sentence MUST still be a correct English sentence using the target vocabulary.
   - feedback MUST explain in Bahasa Indonesia that only English answers are accepted.
   - improvements MUST include that the student must answer in English.
3. Do NOT evaluate grammar or vocabulary if Rule #2 applies.
4. Never give a score above 0 for non-English answers.

If the answer is in English, evaluate based on:
- Correct use of the target vocabulary.
- Grammar.
- Vocabulary usage.
- Naturalness.
- Relevance to agriculture if applicable.

Return ONLY valid JSON.

Feedback, strengths, and improvements must be in Bahasa Indonesia.
Suggested_sentence must be in English.

{
    "score": 0,
    "feedback": "",
    "strengths": [],
    "improvements": [],
    "suggested_sentence": ""
}
PROMPT;
    $userPrompt = <<<PROMPT
    Target Vocabulary:
    {$vocabulary['word']}

    Meaning:
    {$vocabulary['meaning']}

    Definition:
    {$vocabulary['definition']}

    Student Sentence:
    {$sentence}
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
            'feedback' => 'Evaluation failed.',
            'strengths' => [],
            'improvements' => [],
            'suggested_sentence' => '',
        ];
    }

    $score = null;

    $feedback = null;

    $suggestion = null;

    /*
    |--------------------------------------------------------------------------
    | Save Answer
    |--------------------------------------------------------------------------
    */

    $existing = $this->answerModel
        ->where('attempt_id', $attemptId)
        ->first();

    $data = [

        'attempt_id' => $attemptId,

        'answer' => $sentence,

        'score' => (int) $result['score'],

        'ai_feedback' => json_encode([
            'overall' => $result['feedback'],
            'strengths' => $result['strengths'],
            'improvements' => $result['improvements'],
        ], JSON_UNESCAPED_UNICODE),

        'ai_suggestion' => $result['suggested_sentence'],

        'created_at' => date('Y-m-d H:i:s'),

    ];

    if ($existing) {
    unset($data['created_at']);
    $this->answerModel->update($existing['id'], $data);
    $answerId = $existing['id'];
} else {
    $this->answerModel->insert($data);
    $answerId = $this->answerModel->getInsertID();
}

$this->attemptModel->update($attemptId, [
    'completed_at' => date('Y-m-d H:i:s'),
]);

return redirect()->to(site_url('student/vocabulary/feedback/' . $answerId));
    // return redirect()->to('student/vocabulary/feedback/' . $attemptId);
}

public function feedback($answerId)
{
    $userId = session()->get('user_id');

    $answer = $this->answerModel
        ->select('
            vocabulary_answers.*,
            vocabulary_attempts.user_id,
            vocabulary_attempts.vocabulary_id,
            vocabularies.word,
            vocabularies.meaning,
            vocabularies.definition,
            vocabularies.pronunciation
        ')
        ->join(
            'vocabulary_attempts',
            'vocabulary_attempts.id = vocabulary_answers.attempt_id'
        )
        ->join(
            'vocabularies',
            'vocabularies.id = vocabulary_attempts.vocabulary_id'
        )
        ->where('vocabulary_answers.id', $answerId)
        ->first();

    if (!$answer || (int)$answer['user_id'] !== (int)$userId) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('student/vocabulary/feedback', [
        'title'  => 'Vocabulary Feedback',
        'answer' => $answer,
    ]);
}

public function feedbackOLD($attemptId)
{
    $attempt = $this->attemptModel->find($attemptId);

    if (!$attempt) {
        return redirect()->to('student/vocabulary');
    }

    $answer = $this->answerModel
        ->where('attempt_id', $attemptId)
        ->first();

    $vocabulary = $this->vocabularyModel
        ->find($attempt['vocabulary_id']);

    return view('student/vocabulary/feedback', [
        'title'      => 'Vocabulary Feedback',
        'attempt'    => $attempt,
        'answer'     => $answer,
        'vocabulary' => $vocabulary,
    ]);
}

public function chat()
{
    $userId   = session()->get('user_id');
    $answerId = $this->request->getPost('answer_id');
    $message  = trim($this->request->getPost('message'));
    $history  = $this->request->getPost('history') ?? [];

    if (!$message) {
        return $this->response
            ->setJSON(['error' => 'Empty message'])
            ->setStatusCode(400);
    }

    $answer = $this->answerModel
        ->select('
            vocabulary_answers.*,
            vocabulary_attempts.user_id,
            vocabularies.word,
            vocabularies.meaning,
            vocabularies.definition,
            vocabularies.pronunciation,
            
        ')
        ->join(
            'vocabulary_attempts',
            'vocabulary_attempts.id = vocabulary_answers.attempt_id'
        )
        ->join(
            'vocabularies',
            'vocabularies.id = vocabulary_attempts.vocabulary_id'
        )
        ->join(
            'vocabulary_exercises',
            'vocabulary_exercises.vocabulary_id = vocabularies.id',
            'left'
        )
        ->where('vocabulary_answers.id', $answerId)
        ->first();

    if (!$answer || (int)$answer['user_id'] !== (int)$userId) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $feedback = [];

    if (!empty($answer['ai_feedback'])) {
        $feedback = json_decode($answer['ai_feedback'], true);
    }

    // Precompute safe values — heredoc interpolation can't handle ?? inline
    $overallFeedback = $feedback['overall'] ?? '';
    $strength1       = $feedback['strengths'][0] ?? '';
    $strength2       = $feedback['strengths'][1] ?? '';
    $improvement1    = $feedback['improvements'][0] ?? '';
    $improvement2    = $feedback['improvements'][1] ?? '';

  $systemPrompt = <<<PROMPT
You are an English Vocabulary Tutor for POLBANGTAN (college students majoring in Agriculture).

Your role is to help students understand and improve their English vocabulary and sentence construction.

Context:

Target vocabulary:
{$answer['word']}

Meaning:
{$answer['meaning']}

Definition:
{$answer['definition']}

Pronunciation:
{$answer['pronunciation']}

Student sentence:
{$answer['answer']}

AI Score:
{$answer['score']}/100

Overall Feedback:
{$overallFeedback}

Strengths:
- {$strength1}
- {$strength2}

Improvements:
- {$improvement1}
- {$improvement2}

Rules:

1. Only answer questions related to:
   - the target vocabulary,
   - English grammar,
   - pronunciation,
   - vocabulary usage,
   - collocations,
   - sentence improvement,
   - the student's answer,
   - agriculture-related English examples.

2. If the question is unrelated to the learning material, politely refuse and guide the student back to the vocabulary discussion.

3. Detect the language of the user's latest message.
   - If the user writes in Indonesian, reply ONLY in Indonesian.
   - If the user writes in English, reply ONLY in English.
   - Do NOT mix Indonesian and English unless the user explicitly asks for translation or a bilingual explanation.

4. Keep answers concise, clear, and suitable for university students.

5. If giving examples, use the target vocabulary whenever appropriate.

6. Do not invent information that is not supported by the provided context. If you are unsure, say so.

PROMPT;

    $messages = [];

    foreach ($history as $turn) {

        if (!empty($turn['role']) && !empty($turn['content'])) {

            $messages[] = [
                'role'    => $turn['role'] === 'assistant'
                    ? 'assistant'
                    : 'user',
                'content' => $turn['content'],
            ];
        }
    }

    $messages[] = [
        'role' => 'user',
        'content' => $message,
    ];

    $ai = new AnthropicService();

    $reply = $ai->chat($systemPrompt, $messages);

    return $this->response->setJSON([
        'reply' => $reply
    ]);
}
}