<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class HomeAboutModel extends Model
{
    protected $table         = 'homepage_about';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['heading','subheading','description','image'];
    protected $useTimestamps = false;

    public function getRow()
    {
        return $this->find(1);
    }
}