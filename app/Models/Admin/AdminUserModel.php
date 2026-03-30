<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table      = 'admin_users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'password',
    ];

    protected $useTimestamps = false;

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }
}