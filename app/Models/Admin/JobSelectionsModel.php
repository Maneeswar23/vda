<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class JobSelectionsModel extends Model
{
    protected $table         = 'job_selections';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['image','caption','campus'];
    protected $useTimestamps = false;
    public function getRow(){ return $this->find(1); }
}