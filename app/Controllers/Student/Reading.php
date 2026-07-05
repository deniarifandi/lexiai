<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\ReadingMaterialModel;
use App\Models\ReadingAttemptModel;
use App\Models\ReadingAnswerModel;
use App\Models\ReadingQuestionModel;
use App\Services\AnthropicService;

class Reading extends BaseController
{
    protected $readingMaterial;

    protected $attemptModel;
    protected $answerModel;

    public function __construct()
    {
        $this->readingMaterial = new ReadingMaterialModel();
        $this->questionModel   = new ReadingQuestionModel();
        $this->attemptModel    = new ReadingAttemptModel();
        $this->answerModel     = new ReadingAnswerModel();
    }

    /**
     * Reading List
     */
  public function index()
{
    $userId = session()->get('user_id');

    $subQuery = "
        (
            SELECT
                material_id,
                MAX(CASE WHEN status = 'completed' THEN total_score END) AS highest_score,
                MAX(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) AS has_in_progress
            FROM reading_attempts
            WHERE user_id = {$userId}
            GROUP BY material_id
        ) ra
    ";

    $materials = [];

    foreach (['beginner', 'intermediate', 'advanced'] as $level) {
        $materials[$level] = $this->readingMaterial
            ->select('
                reading_materials.*,
                COALESCE(ra.highest_score, 0) AS highest_score,
                COALESCE(ra.has_in_progress, 0) AS has_in_progress
            ')
            ->selectCount('reading_questions.id', 'total_questions')
            ->join('reading_questions', 'reading_questions.material_id = reading_materials.id', 'left')
            ->join($subQuery, 'ra.material_id = reading_materials.id', 'left', false)
            ->where('reading_materials.status', 1)
            ->where('reading_materials.level', $level)
            ->groupBy('reading_materials.id')
            ->orderBy('reading_questions.order_number', 'ASC')
            ->findAll();
    }

    return view('student/reading/index', [
        'materials' => $materials,
    ]);
}

public function start($materialId)
{
    $userId = session()->get('user_id');

    $material = $this->readingMaterial
        ->where('id', $materialId)
        ->where('status', 1)
        ->first();

    if (!$material) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Kalau masih ada attempt yang belum selesai, lanjutkan itu
    $existingAttempt = $this->attemptModel
        ->where('user_id', $userId)
        ->where('material_id', $materialId)
        ->where('status', 'in_progress')
        ->first();

    if ($existingAttempt) {
        return redirect()->to(site_url('student/reading/test/' . $existingAttempt['id']));
    }

    // Kalau sudah pernah selesai (atau belum pernah sama sekali), buat attempt baru
    $attemptId = $this->attemptModel->insert([
        'user_id'     => $userId,
        'material_id' => $materialId,
        'status'      => 'in_progress',
        'started_at'  => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to(site_url('student/reading/test/' . $attemptId));
}

    /**
     * Reading Overview
     */
  public function show($id)
    {
        $material = $this->readingMaterial
            ->select('reading_materials.*')
            ->selectCount('reading_questions.id','total_questions')
            ->join(
                'reading_questions',
                'reading_questions.material_id=reading_materials.id',
                'left'
            )
            ->where('reading_materials.id',$id)
            ->where('reading_materials.status',1)
            ->groupBy('reading_materials.id')
            ->first();

        if (!$material) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('student/reading/show',[
            'material'=>$material
        ]);
    }

   public function test($attemptId)
{
    $userId = session()->get('user_id');

    $attempt = $this->attemptModel
        ->where('id', $attemptId)
        ->where('user_id', $userId)
        ->first();

    if (!$attempt) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    if ($attempt['status'] == 'completed') {
        return redirect()->to(site_url('student/reading/result/' . $attemptId));
    }

    $material = $this->readingMaterial->find($attempt['material_id']);

    $questions = $this->questionModel
        ->where('material_id', $material['id'])
        ->orderBy('order_number')
        ->findAll();

    $answered = $this->answerModel
        ->where('attempt_id', $attemptId)
        ->findColumn('question_id') ?? [];

    $question = null;
    $current = 1;

    foreach ($questions as $i => $q) {

        if (!in_array($q['id'], $answered)) {

            $question = $q;
            $current = $i + 1;
            break;
        }
    }

    if (!$question) {
        return redirect()->to(site_url('student/reading/result/' . $attemptId));
    }

    return view('student/reading/test', [
        'attempt'  => $attempt,
        'material' => $material,
        'question' => $question,
        'current'  => $current,
        'total'    => count($questions),
    ]);
}

    public function submit($materialId)
{
    $userId = session()->get('user_id');

    $material = $this->readingMaterial
        ->where('id', $materialId)
        ->where('status', 1)
        ->first();

    if (!$material) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $answers = $this->request->getPost('answers');

    if (!$answers) {
        return redirect()->back()->with('error', 'Belum ada jawaban yang dikirim.');
    }

    $attemptId = $this->attemptModel->insert([
        'user_id'      => $userId,
        'material_id'  => $materialId,
        'status'       => 'in_progress',
        'started_at'   => date('Y-m-d H:i:s'),
    ]);

    foreach ($answers as $questionId => $answer) {
        $this->answerModel->insert([
            'attempt_id'  => $attemptId,
            'question_id' => $questionId,
            'answer'      => trim($answer),
        ]);
    }

    $totalQuestions = $this->questionModel
        ->where('material_id', $materialId)
        ->countAllResults();

    $answeredQuestions = count($answers);

    if ($answeredQuestions >= $totalQuestions) {

        $this->attemptModel->update($attemptId, [
            'status'       => 'completed',
            'completed_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('student/reading/result/' . $attemptId));
    }

    return redirect()->to(site_url('student/reading/test/' . $attemptId));
}

 public function result($attemptId)
{
    $attemptModel = new \App\Models\ReadingAttemptModel();
    $answerModel  = new \App\Models\ReadingAnswerModel();

    $userId = session()->get('user_id');

    $attempt = $attemptModel
        ->where('id', $attemptId)
        ->where('user_id', $userId)
        ->first();

    if (!$attempt) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $answers = $answerModel
        ->select('reading_answers.*, reading_questions.question')
        ->join('reading_questions', 'reading_questions.id = reading_answers.question_id')
        ->where('reading_answers.attempt_id', $attemptId)
        ->orderBy('reading_questions.order_number', 'ASC')
        ->findAll();

    $finalScore = 0;

    if (!empty($answers)) {
        $finalScore = round(
            array_sum(array_column($answers, 'ai_score')) / count($answers),
            1
        );
    }

    $attemptModel->update($attemptId, [
        'status'       => 'completed',
        'completed_at' => date('Y-m-d H:i:s'),
        'total_score'  => $finalScore,
    ]);

    $attempt['status'] = 'completed';
    $attempt['total_score'] = $finalScore;

    return view('student/reading/result', [
        'attempt' => $attempt,
        'answers' => $answers,
    ]);
}

   public function saveAnswer()
{
    $userId     = session()->get('user_id');
    $attemptId  = $this->request->getPost('attempt_id');
    $questionId = $this->request->getPost('question_id');
    $answer     = trim($this->request->getPost('answer'));

    $attempt = $this->attemptModel
        ->where('id', $attemptId)
        ->where('user_id', $userId)
        ->first();

    if (!$attempt) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    if ($attempt['status'] === 'completed') {
        return redirect()->to(site_url('student/reading/result/' . $attemptId));
    }

    // Cegah jawaban ganda
    $existing = $this->answerModel
        ->where('attempt_id', $attemptId)
        ->where('question_id', $questionId)
        ->first();

    if ($existing) {

        $answerId = $existing['id'];

        $this->answerModel->update($answerId, [
            'answer' => $answer,
        ]);

    } else {

        $answerId = $this->answerModel->insert([
            'attempt_id'  => $attemptId,
            'question_id' => $questionId,
            'answer'      => $answer,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | AI Evaluation
    |--------------------------------------------------------------------------
    | Nanti dipanggil di sini
    */

    // Contoh sementara
    $this->answerModel->update($answerId, [
        'ai_score'    => 85,
        'ai_feedback' => 'Temporary feedback.',
    ]);

    return redirect()->to(site_url('student/reading/feedback/' . $answerId));
}

    public function feedback($answerId)
{
    $answer = $this->answerModel
    ->select('
        reading_answers.*,
        reading_questions.question,
        reading_questions.reference_answer,
        reading_materials.id as material_id,
        reading_materials.title as material_title
    ')
    ->join(
        'reading_questions',
        'reading_questions.id = reading_answers.question_id'
    )
    ->join(
        'reading_attempts',
        'reading_attempts.id = reading_answers.attempt_id'
    )
    ->join(
        'reading_materials',
        'reading_materials.id = reading_attempts.material_id'
    )
    ->where('reading_answers.id', $answerId)
    ->first();

    if (!$answer) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Total soal
    $totalQuestions = $this->questionModel
        ->where('material_id', $answer['material_id'])
        ->countAllResults();

    // Jumlah soal yang sudah dijawab
    $answeredQuestions = $this->answerModel
        ->where('attempt_id', $answer['attempt_id'])
        ->countAllResults();

    $isFinished = ($answeredQuestions >= $totalQuestions);

    return view('student/reading/feedback', [
        'answer'            => $answer,
        'totalQuestions'    => $totalQuestions,
        'answeredQuestions' => $answeredQuestions,
        'isFinished'        => $isFinished,
    ]);
}


    public function chat()
    {
        $userId    = session()->get('user_id');
        $answerId  = $this->request->getPost('answer_id');
        $message   = trim($this->request->getPost('message'));
        $history   = $this->request->getPost('history') ?? []; // [{role, content}, ...]

        if (!$message) {
            return $this->response->setJSON(['error' => 'Empty message'])->setStatusCode(400);
        }

        $answer = $this->answerModel
            ->select('
                reading_answers.*,
                reading_questions.question,
                reading_questions.reference_answer,
                reading_attempts.user_id
            ')
            ->join('reading_questions', 'reading_questions.id = reading_answers.question_id')
            ->join('reading_attempts', 'reading_attempts.id = reading_answers.attempt_id')
            ->where('reading_answers.id', $answerId)
            ->first();

        if (!$answer || (int) $answer['user_id'] !== (int) $userId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $systemPrompt = "You are a helpful English tutor explaining feedback on a student's reading comprehension essay answer.\n\n"
            . "Question: {$answer['question']}\n\n"
            . "Student's answer: {$answer['answer']}\n\n"
            . "AI score given: {$answer['ai_score']}/100\n"
            . "AI feedback given: {$answer['ai_feedback']}\n\n"
            . "Reference answer: " . ($answer['reference_answer'] ?? 'N/A') . "\n\n"
            . "Answer the student's follow-up questions about this feedback clearly and encouragingly, "
            . "in simple English suitable for an agriculture-student learner. Keep replies concise.";

        $messages = [];

        foreach ($history as $turn) {
            if (!empty($turn['role']) && !empty($turn['content'])) {
                $messages[] = [
                    'role'    => $turn['role'] === 'assistant' ? 'assistant' : 'user',
                    'content' => $turn['content'],
                ];
            }
        }

        $messages[] = ['role' => 'user', 'content' => $message];

        $ai = new AnthropicService();
        $reply = $ai->chat($systemPrompt, $messages);

        return $this->response->setJSON(['reply' => $reply]);
    }
}