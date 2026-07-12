<?php

namespace App\Controllers;

use App\Models\VocabularyModel;
use App\Models\VocabularyCategoryModel;

class Vocabularies extends BaseController
{
    public function index()
    {
        $model = new VocabularyModel();

        $data['vocabularies'] = $model
            ->select('vocabularies.*, vocabulary_categories.name as category')
            ->join('vocabulary_categories', 'vocabulary_categories.id = vocabularies.category_id')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('admin/vocabularies/index', $data);
    }

    public function create()
    {
        $categoryModel = new VocabularyCategoryModel();

        $data['categories'] = $categoryModel
            ->orderBy('name')
            ->findAll();

        return view('admin/vocabularies/create', $data);
    }

    public function store()
    {
        $model = new VocabularyModel();

        $model->save([

            'category_id' => $this->request->getPost('category_id'),

            'word' => $this->request->getPost('word'),

            'meaning' => $this->request->getPost('meaning'),

            'definition' => $this->request->getPost('definition'),

            'pronunciation' => $this->request->getPost('pronunciation'),

            'audio_url' => $this->request->getPost('audio_url'),

            'image_url' => $this->request->getPost('image_url'),

            'difficulty' => $this->request->getPost('difficulty'),

        ]);

        return redirect()->to('/admin/vocabularies')
            ->with('success', 'Vocabulary created successfully.');
    }

    public function edit($id)
    {
        $model = new VocabularyModel();
        $categoryModel = new VocabularyCategoryModel();

        $data['vocabulary'] = $model->find($id);

        $data['categories'] = $categoryModel
            ->orderBy('name')
            ->findAll();

        return view('admin/vocabularies/edit', $data);
    }

    public function update($id)
    {
        $model = new VocabularyModel();

        $model->update($id, [

            'category_id' => $this->request->getPost('category_id'),

            'word' => $this->request->getPost('word'),

            'meaning' => $this->request->getPost('meaning'),

            'definition' => $this->request->getPost('definition'),

            'pronunciation' => $this->request->getPost('pronunciation'),

            'audio_url' => $this->request->getPost('audio_url'),

            'image_url' => $this->request->getPost('image_url'),

            'difficulty' => $this->request->getPost('difficulty'),

        ]);

        return redirect()->to('/admin/vocabularies')
            ->with('success', 'Vocabulary updated successfully.');
    }

    public function delete($id)
    {
        $model = new VocabularyModel();

        $model->delete($id);

        return redirect()->to('/admin/vocabularies')
            ->with('success', 'Vocabulary deleted successfully.');
    }
}