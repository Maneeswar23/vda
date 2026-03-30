<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class GalleryPhotosModel extends Model
{
    protected $table         = 'gallery_photos';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['image','caption','sort_order','status'];
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