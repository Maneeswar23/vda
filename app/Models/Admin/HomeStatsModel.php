<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class HomeStatsModel extends Model
{
    protected $table         = 'homepage_stats';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['number','label','icon','sort_order'];
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->orderBy('sort_order','ASC')->findAll();
    }
}