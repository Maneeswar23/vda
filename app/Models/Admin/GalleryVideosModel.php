<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class GalleryVideosModel extends Model
{
    protected $table         = 'gallery_videos';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title','youtube_url','thumbnail','sort_order','status'];
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->orderBy('sort_order','ASC')->findAll();
    }

    public function getActive()
    {
        return $this->where('status',1)->orderBy('sort_order','ASC')->findAll();
    }

    // Extract YouTube video ID from URL
    public static function extractVideoId(string $url): string
    {
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m);
        return $m[1] ?? '';
    }
}