<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table         = 'courses';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title','description','image','sort_order','status'];
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