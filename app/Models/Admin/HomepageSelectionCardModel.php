<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class HomepageSelectionCardModel extends Model
{
    protected $table         = 'homepage_selection_cards';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title', 'count_value', 'label', 'location', 'badge', 'sort_order', 'status'];
    protected $useTimestamps = false;

    public function getActive()
    {
        return $this->where('status', 1)->orderBy('sort_order', 'ASC')->findAll();
    }
}
