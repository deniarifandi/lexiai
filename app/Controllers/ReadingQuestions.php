<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReadingMaterialModel;
use App\Models\ReadingQuestionModel;

class ReadingQuestions extends BaseController
{
    protected $materialModel;
    protected $questionModel;

    public function __construct()
    {
        $this->materialModel = new ReadingMaterialModel();
        $this->questionModel = new ReadingQuestionModel();
    }

    public function index($materialId)
    {
        $material = $this->materialModel->find($materialId);

        if (!$material) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $questions = $this->questionModel
            ->where('material_id', $materialId)
            ->orderBy('order_number', 'ASC')
            ->findAll();

        return view('reading_questions/index', [
            'material'  => $material,
            'questions' => $questions
        ]);
    }

    public function create($materialId)
    {
        $material = $this->materialModel->find($materialId);

        if (!$material) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('reading_questions/create', [
            'material' => $material
        ]);
    }

    public function store()
    {
        $materialId = $this->request->getPost('material_id');

        $this->questionModel->insert([
            'material_id'      => $materialId,
            'question'         => $this->request->getPost('question'),
            'reference_answer' => $this->request->getPost('reference_answer'),
            'keywords'         => $this->request->getPost('keywords'),
            'order_number'     => $this->request->getPost('order_number'),
        ]);

        return redirect()->to(base_url('admin/reading-materials/questions/'.$materialId))
            ->with('success', 'Question berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $question = $this->questionModel->find($id);

        if (!$question) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $material = $this->materialModel->find($question['material_id']);

        return view('reading_questions/edit', [
            'material' => $material,
            'question' => $question
        ]);
    }

    public function update($id)
    {
        $question = $this->questionModel->find($id);

        if (!$question) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->questionModel->update($id, [
            'question'         => $this->request->getPost('question'),
            'reference_answer' => $this->request->getPost('reference_answer'),
            'keywords'         => $this->request->getPost('keywords'),
            'order_number'     => $this->request->getPost('order_number'),
        ]);

        return redirect()->to(base_url('admin/reading-materials/questions/'.$question['material_id']))
            ->with('success', 'Question berhasil diperbarui.');
    }

    public function delete($id)
    {
        $question = $this->questionModel->find($id);

        if (!$question) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $materialId = $question['material_id'];

        $this->questionModel->delete($id);

        return redirect()->to(base_url('admin/reading-materials/questions/'.$materialId))
            ->with('success', 'Question berhasil dihapus.');
    }
}