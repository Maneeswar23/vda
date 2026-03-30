<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class MedicalCounsellingModel extends Model
{
    protected $table         = 'medical_counselling';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['image','caption','campus'];
    protected $useTimestamps = false;
    public function getRow(){ return $this->find(1); }
}