<?php
// ════════════════════════════════════════════════════════
// FILE: app/Models/Admin/HomeBannerModel.php
// ════════════════════════════════════════════════════════
namespace App\Models\Admin;
use CodeIgniter\Model;

class HomeBannerModel extends Model
{
    protected $table         = 'homepage_banners';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title','subtitle','button_text','button_link','image','sort_order','status'];
    protected $useTimestamps = false;

    public function getActive()
    {
        return $this->where('status', 1)->orderBy('sort_order', 'ASC')->findAll();
    }

    public function getAll()
    {
        return $this->orderBy('sort_order', 'ASC')->findAll();
    }
}