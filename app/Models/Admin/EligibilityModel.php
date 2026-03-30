<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class EligibilityModel extends Model
{
    protected $table         = 'eligibility';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['image','caption','campus'];
    protected $useTimestamps = false;
    public function getRow(){ return $this->find(1); }
}