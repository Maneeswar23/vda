<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table         = 'settings';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['key','value'];
    protected $useTimestamps = false;

    // Get all settings as key => value array
    public function getAllSettings(): array
    {
        $rows = $this->findAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    // Get single setting value
    public function getSetting(string $key, string $default = ''): string
    {
        $row = $this->where('key', $key)->first();
        return $row ? ($row['value'] ?? $default) : $default;
    }

    // Save/update a setting
    public function setSetting(string $key, string $value): void
    {
        $existing = $this->where('key', $key)->first();
        if ($existing) {
            $this->update($existing['id'], ['value' => $value]);
        } else {
            $this->insert(['key' => $key, 'value' => $value]);
        }
    }

    // Save multiple settings at once
    public function saveSettings(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->setSetting($key, $value);
        }
    }
}