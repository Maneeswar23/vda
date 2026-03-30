<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table         = 'faq';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['question','answer','sort_order','status'];
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->orderBy('sort_order','ASC')->findAll();
    }

    public function getActive()
    {
        return $this->where('status',1)->orderBy('sort_order','ASC')->findAll();
    }
}