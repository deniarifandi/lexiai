<?php

namespace App\Controllers;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (! session()->get('logged_in')) {
            redirect()->to('/login')->send();
            exit;
        }

        if (session()->get('role') !== 'admin') {
            redirect()->to('/dashboard')->send();
            exit;
        }
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function users()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel
            ->orderBy('username')
            ->findAll();

        return view('admin/users', $data);
    }

    public function createUser()
    {
        return view('admin/create_user');
    }

    public function storeUser()
    {
        $userModel = new \App\Models\UserModel();

        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()
            ->to('/admin/users')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser($id)
    {
        $userModel = new \App\Models\UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/edit_user', [
            'user' => $user
        ]);
    }

    public function updateUser($id)
    {
        $userModel = new \App\Models\UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users');
        }

        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role'     => 'required'
        ];

        // Password hanya divalidasi jika diisi
        if ($this->request->getPost('password') != '') {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password') != '') {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $userModel->update($id, $data);

        return redirect()
            ->to('/admin/users')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        $userModel = new \App\Models\UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'User tidak ditemukan.');
        }

        // Mencegah admin menghapus akunnya sendiri
        if ($id == session()->get('user_id')) {
            return redirect()
                ->to('/admin/users')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        if ($user['role'] === 'admin') {

            $adminCount = $userModel->where('role', 'admin')->countAllResults();

            if ($adminCount <= 1) {
                return redirect()
                    ->to('/admin/users')
                    ->with('error', 'Minimal harus ada satu akun administrator.');
            }
        }

        $userModel->delete($id);

        return redirect()
            ->to('/admin/users')
            ->with('success', 'User berhasil dihapus.');
    }

    public function modules()
    {
        return view('admin/modules');
    }

    public function reports()
    {
        return view('admin/reports');
    }

    public function settings()
    {
        return view('admin/settings');
    }
}