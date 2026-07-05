<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReadingMaterialModel;

class ReadingMaterials extends BaseController
{
    protected $readingMaterial;

    public function __construct()
    {
        $this->readingMaterial = new ReadingMaterialModel();
    }

    public function index()
    {
        $data['materials'] = $this->readingMaterial
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('reading_materials/index', $data);
    }

    public function create()
    {
        return view('reading_materials/create');
    }

    public function store()
    {
        $this->readingMaterial->save([
            'title'               => $this->request->getPost('title'),
            'topic'               => $this->request->getPost('topic'),
            'level'               => $this->request->getPost('level'),
            'content'             => $this->request->getPost('content'),
            'estimated_minutes'   => $this->request->getPost('estimated_minutes'),
            'status'              => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/reading-materials')
            ->with('success', 'Reading material berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['material'] = $this->readingMaterial->find($id);

        if (!$data['material']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('reading_materials/edit', $data);
    }

    public function update($id)
    {
        $this->readingMaterial->update($id, [
            'title'               => $this->request->getPost('title'),
            'topic'               => $this->request->getPost('topic'),
            'level'               => $this->request->getPost('level'),
            'content'             => $this->request->getPost('content'),
            'estimated_minutes'   => $this->request->getPost('estimated_minutes'),
            'status'              => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/reading-materials')
            ->with('success', 'Reading material berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->readingMaterial->delete($id);

        return redirect()->to('/admin/reading-materials')
            ->with('success', 'Reading material berhasil dihapus.');
    }
}