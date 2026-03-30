<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminUserModel;

class AuthController extends BaseController
{
    protected $adminUserModel;

    public function __construct()
    {
        $this->adminUserModel = new AdminUserModel();
        helper(['url', 'form']);
    }

    // ── GET: show login form ──────────────────────────────
    public function login()
    {
        // if already logged in redirect to dashboard
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/auth/login');
    }

    // ── POST: process login ───────────────────────────────
    public function loginPost()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // find user by email
        $user = $this->adminUserModel->findByEmail($email);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid email or password.');
        }

        // verify password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid email or password.');
        }

        // set session
        session()->set([
            'admin_logged_in' => true,
            'admin_id'        => $user['id'],
            'admin_username'  => $user['username'],
            'admin_email'     => $user['email'],
        ]);

        return redirect()->to(base_url('admin/dashboard'))
            ->with('success', 'Welcome back, ' . $user['username'] . '!');
    }

    // ── GET: logout ───────────────────────────────────────
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'))
            ->with('success', 'You have been logged out successfully.');
    }
}