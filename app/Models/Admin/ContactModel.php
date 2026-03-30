<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table         = 'contacts';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name','email','phone','interest','message','is_read'];
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->orderBy('created_at','DESC')->findAll();
    }

    public function getUnread()
    {
        return $this->where('is_read',0)->orderBy('created_at','DESC')->findAll();
    }

    public function markRead(int $id)
    {
        return $this->update($id, ['is_read' => 1]);
    }

    public function countUnread(): int
    {
        return $this->where('is_read',0)->countAllResults();
    }
}