<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class FacilitiesModel extends Model
{
    protected $table         = 'facilities';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title','icon','badge','badge_icon','features','sort_order','status'];
    protected $useTimestamps = false;

    public function getActive()
    {
        return $this->where('status',1)->orderBy('sort_order','ASC')->findAll();
    }

    public function getAll()
    {
        return $this->orderBy('sort_order','ASC')->findAll();
    }
}