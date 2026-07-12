<?php

namespace App\Controllers;

use App\Models\VocabularyExampleModel;
use App\Models\VocabularyModel;

class VocabularyExamples extends BaseController
{
    protected $exampleModel;
    protected $vocabularyModel;

    public function __construct()
    {
        $this->exampleModel    = new VocabularyExampleModel();
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
            'title'      => 'Vocabulary Examples',
            'vocabulary' => $vocabulary,
            'examples'   => $this->exampleModel
                ->where('vocabulary_id', $vocabularyId)
                ->orderBy('id', 'ASC')
                ->findAll(),
        ];

        return view('admin/vocabulary_examples/index', $data);
    }

    public function create($vocabularyId)
    {
        $vocabulary = $this->vocabularyModel->find($vocabularyId);

        if (!$vocabulary) {
            return redirect()->to('admin/vocabularies')
                ->with('error', 'Vocabulary not found.');
        }

        return view('admin/vocabulary_examples/create', [
            'title'      => 'Add Example',
            'vocabulary' => $vocabulary,
        ]);
    }

    public function store()
    {
        $this->exampleModel->insert([
            'vocabulary_id' => $this->request->getPost('vocabulary_id'),
            'sentence'      => $this->request->getPost('sentence'),
            'translation'   => $this->request->getPost('translation'),
        ]);

        return redirect()->to(
            'admin/vocabularies/examples/' . $this->request->getPost('vocabulary_id')
        )->with('success', 'Example added successfully.');
    }

    public function edit($id)
    {
        $example = $this->exampleModel->find($id);

        if (!$example) {
            return redirect()->back()
                ->with('error', 'Example not found.');
        }

        $vocabulary = $this->vocabularyModel->find($example['vocabulary_id']);

        return view('admin/vocabulary_examples/edit', [
            'title'      => 'Edit Example',
            'example'    => $example,
            'vocabulary' => $vocabulary,
        ]);
    }

    public function update($id)
    {
        $example = $this->exampleModel->find($id);

        if (!$example) {
            return redirect()->back()
                ->with('error', 'Example not found.');
        }

        $this->exampleModel->update($id, [
            'sentence'    => $this->request->getPost('sentence'),
            'translation' => $this->request->getPost('translation'),
        ]);

        return redirect()->to(
            'admin/vocabularies/examples/' . $example['vocabulary_id']
        )->with('success', 'Example updated successfully.');
    }

    public function delete($id)
    {
        $example = $this->exampleModel->find($id);

        if (!$example) {
            return redirect()->back()
                ->with('error', 'Example not found.');
        }

        $vocabularyId = $example['vocabulary_id'];

        $this->exampleModel->delete($id);

        return redirect()->to(
            'admin/vocabularies/examples/' . $vocabularyId
        )->with('success', 'Example deleted successfully.');
    }
}