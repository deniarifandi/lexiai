<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Invalid input.');
        }

        $email    = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();

        if (! $user) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        if (! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        session()->regenerate();

        session()->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'logged_in' => true,
        ]);

        if ($this->request->getPost('remember')) {

            helper('text');

            $selector = random_string('alnum', 24);
            $token    = bin2hex(random_bytes(32));

            $userModel->db->table('user_remember_tokens')->insert([
                'user_id'    => $user['id'],
                'selector'   => $selector,
                'token_hash' => hash('sha256', $token),
                'expires_at' => date('Y-m-d H:i:s', strtotime('+30 days')),
            ]);

            setcookie(
                'remember_me',
                $selector . ':' . $token,
                [
                    'expires'  => time() + (60 * 60 * 24 * 30),
                    'path'     => '/',
                    'secure'   => ENVIRONMENT === 'production',
                    'httponly' => true,
                    'samesite' => 'Lax',
                ]
            );
        }

        $userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
       
        if (isset($_COOKIE['remember_me'])) {

            [$selector] = explode(':', $_COOKIE['remember_me']);

            db_connect()
                ->table('user_remember_tokens')
                ->where('selector', $selector)
                ->delete();

            setcookie(
                'remember_me',
                '',
                [
                    'expires' => time() - 3600,
                    'path'    => '/',
                ]
            );
        }

        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new \App\Models\UserModel();

        $userModel->insert([
            'username'  => trim($this->request->getPost('username')),
            'email'     => trim($this->request->getPost('email')),
            'password'  => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'is_active' => 1,
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }
}   