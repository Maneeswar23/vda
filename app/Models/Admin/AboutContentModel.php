<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AboutContentModel extends Model
{
    protected $table      = 'about_content';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'section_key',
        'heading',
        'description',
        'image',
    ];

    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';
    protected $createdField  = '';

    // ── Get single section by key ──
    public function getSection(string $key): array
    {
        $row = $this->where('section_key', $key)->first();
        return $row ?? ['section_key' => $key, 'heading' => '', 'description' => '', 'image' => ''];
    }

    // ── Get all sections as key => row array ──
    public function getAllKeyed(): array
    {
        $rows   = $this->findAll();
        $keyed  = [];
        foreach ($rows as $row) {
            $keyed[$row['section_key']] = $row;
        }
        return $keyed;
    }

    // ── Upsert (insert or update) by section_key ──
    public function upsert(string $key, array $data): void
    {
        $existing = $this->where('section_key', $key)->first();
        $data['section_key'] = $key;
        if ($existing) {
            $this->update($existing['id'], $data);
        } else {
            $this->insert($data);
        }
    }
}