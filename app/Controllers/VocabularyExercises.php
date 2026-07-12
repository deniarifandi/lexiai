<?php

namespace App\Controllers;

use App\Models\VocabularyExerciseModel;
use App\Models\VocabularyModel;

class VocabularyExercises extends BaseController
{
    protected $exerciseModel;
    protected $vocabularyModel;

    public function __construct()
    {
        $this->exerciseModel = new VocabularyExerciseModel();
        $this->vocabularyModel = new VocabularyModel();
    }

    public function index($vocabularyId)
    {
        $vocabulary = $this->vocabularyModel->find($vocabularyId);

        if (!$vocabulary) {
            return redirect()->to('admin/vocabularies')
                ->with('error', 'Vocabulary not found.');
        }

        $data = [
            'title' => 'Vocabulary Exercises',
            'vocabulary' => $vocabulary,
            'exercises' => $this->exerciseModel
                ->where('vocabulary_id', $vocabularyId)
                ->findAll(),
        ];

        return view('admin/vocabulary_exercises/index', $data);
    }

    public function create($vocabularyId)
    {
        return view('admin/vocabulary_exercises/create', [
            'title' => 'Add Exercise',
            'vocabulary' => $this->vocabularyModel->find($vocabularyId)
        ]);
    }

    public function store()
    {
        $this->exerciseModel->insert([
            'vocabulary_id' => $this->request->getPost('vocabulary_id'),
            'question' => $this->request->getPost('question'),
            'expected_answer' => $this->request->getPost('expected_answer'),
            'difficulty' => $this->request->getPost('difficulty'),
        ]);

        return redirect()->to(
            'admin/vocabularies/exercises/' .
            $this->request->getPost('vocabulary_id')
        )->with('success', 'Exercise added.');
    }

    public function edit($id)
    {
        $exercise = $this->exerciseModel->find($id);

        return view('admin/vocabulary_exercises/edit', [
            'title' => 'Edit Exercise',
            'exercise' => $exercise,
            'vocabulary' => $this->vocabularyModel->find($exercise['vocabulary_id'])
        ]);
    }

    public function update($id)
    {
        $exercise = $this->exerciseModel->find($id);

        $this->exerciseModel->update($id, [
            'question' => $this->request->getPost('question'),
            'expected_answer' => $this->request->getPost('expected_answer'),
            'difficulty' => $this->request->getPost('difficulty'),
        ]);

        return redirect()->to(
            'admin/vocabularies/exercises/' .
            $exercise['vocabulary_id']
        )->with('success', 'Exercise updated.');
    }

    public function delete($id)
    {
        $exercise = $this->exerciseModel->find($id);

        $vocabularyId = $exercise['vocabulary_id'];

        $this->exerciseModel->delete($id);

        return redirect()->to(
            'admin/vocabularies/exercises/' . $vocabularyId
        )->with('success', 'Exercise deleted.');
    }
}