<?php

/**
 * CMS Helper — Visakha Defence Academy
 * Handles file uploads, deletions, and utility functions
 * Used across all admin controllers
 */

// ============================================================
// UPLOAD A FILE
// ============================================================
/**
 * Upload a file to public/uploads/<folder>/
 *
 * @param  \CodeIgniter\HTTP\Files\UploadedFile $file
 * @param  string $folder  e.g. 'banners', 'gallery/photos', 'courses'
 * @return string          saved filename on success, '' on failure
 */
if (!function_exists('cms_upload')) {
    function cms_upload($file, string $folder): string
    {
        if (!$file->isValid() || $file->hasMoved()) {
            return '';
        }

        // allowed mime types
        $allowedTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/webp',
            'image/gif',
        ];

        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return '';
        }

        // max size 5MB
        if ($file->getSizeByUnit('mb') > 5) {
            return '';
        }

        // destination folder
        $uploadPath = FCPATH . 'public/uploads/' . trim($folder, '/') . '/';

        // create folder if not exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        // generate unique filename
        $newName = $file->getRandomName();

        // move file
        if ($file->move($uploadPath, $newName)) {
            return $newName;
        }

        return '';
    }
}

// ============================================================
// DELETE A FILE
// ============================================================
/**
 * Delete an uploaded file from public/uploads/
 *
 * @param  string $relativePath  e.g. 'banners/filename.jpg'
 * @return bool
 */
if (!function_exists('cms_delete_file')) {
    function cms_delete_file(string $relativePath): bool
    {
        if (empty($relativePath)) {
            return false;
        }

        $fullPath = FCPATH . 'public/uploads/' . ltrim($relativePath, '/');

        if (file_exists($fullPath) && is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}

// ============================================================
// GET IMAGE URL WITH FALLBACK
// ============================================================
/**
 * Get full image URL — checks uploads first, then assets/images, then placeholder
 *
 * @param  string $filename     just the filename e.g. 'banner-01.jpg'
 * @param  string $uploadFolder upload subfolder e.g. 'banners'
 * @return string               full URL
 */
if (!function_exists('cms_image_url')) {
    function cms_image_url(string $filename, string $uploadFolder): string
    {
        if (empty($filename)) {
            return base_url('public/assets/images/placeholder.jpg');
        }

        // check uploads folder first
        if (file_exists(FCPATH . 'public/uploads/' . trim($uploadFolder, '/') . '/' . $filename)) {
            return base_url('public/uploads/' . trim($uploadFolder, '/') . '/' . $filename);
        }

        // fallback to assets/images
        if (file_exists(FCPATH . 'public/assets/images/' . $filename)) {
            return base_url('public/assets/images/' . $filename);
        }

        // final fallback placeholder
        return base_url('public/assets/images/placeholder.jpg');
    }
}

// ============================================================
// GET YOUTUBE VIDEO ID FROM URL
// ============================================================
/**
 * Extract YouTube video ID from any YouTube URL format
 *
 * @param  string $url
 * @return string video ID or ''
 */
if (!function_exists('cms_youtube_id')) {
    function cms_youtube_id(string $url): string
    {
        if (empty($url)) {
            return '';
        }

        // handle youtu.be short links
        if (str_contains($url, 'youtu.be/')) {
            $parts = explode('youtu.be/', $url);
            return explode('?', $parts[1])[0];
        }

        // handle youtube.com/watch?v=
        if (str_contains($url, 'youtube.com/watch')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            return $params['v'] ?? '';
        }

        // handle youtube.com/embed/
        if (str_contains($url, 'youtube.com/embed/')) {
            $parts = explode('youtube.com/embed/', $url);
            return explode('?', $parts[1])[0];
        }

        return '';
    }
}

// ============================================================
// GET YOUTUBE THUMBNAIL URL
// ============================================================
/**
 * Get YouTube thumbnail URL from video URL
 *
 * @param  string $url       YouTube video URL
 * @param  string $quality   maxresdefault | hqdefault | mqdefault | default
 * @return string            thumbnail URL
 */
if (!function_exists('cms_youtube_thumb')) {
    function cms_youtube_thumb(string $url, string $quality = 'hqdefault'): string
    {
        $id = cms_youtube_id($url);
        if (empty($id)) {
            return base_url('public/assets/images/placeholder.jpg');
        }
        return 'https://img.youtube.com/vi/' . $id . '/' . $quality . '.jpg';
    }
}

// ============================================================
// GET YOUTUBE EMBED URL
// ============================================================
/**
 * Convert any YouTube URL to embed URL
 *
 * @param  string $url
 * @return string embed URL
 */
if (!function_exists('cms_youtube_embed')) {
    function cms_youtube_embed(string $url): string
    {
        $id = cms_youtube_id($url);
        if (empty($id)) {
            return '';
        }
        return 'https://www.youtube.com/embed/' . $id;
    }
}

// ============================================================
// TRUNCATE TEXT
// ============================================================
/**
 * Truncate text to a given length
 *
 * @param  string $text
 * @param  int    $length
 * @param  string $suffix
 * @return string
 */
if (!function_exists('cms_truncate')) {
    function cms_truncate(string $text, int $length = 100, string $suffix = '...'): string
    {
        if (empty($text)) {
            return '';
        }
        if (mb_strlen($text) <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length) . $suffix;
    }
}

// ============================================================
// CLEAN SLUG
// ============================================================
/**
 * Convert a string to a URL-friendly slug
 *
 * @param  string $text
 * @return string
 */
if (!function_exists('cms_slug')) {
    function cms_slug(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        return trim($text, '-');
    }
}

// ============================================================
// FORMAT DATE
// ============================================================
/**
 * Format a date string
 *
 * @param  string $date
 * @param  string $format
 * @return string
 */
if (!function_exists('cms_date')) {
    function cms_date(string $date, string $format = 'd M Y'): string
    {
        if (empty($date)) {
            return '—';
        }
        return date($format, strtotime($date));
    }
}

// ============================================================
// ACTIVE NAV HELPER
// ============================================================
/**
 * Return 'active' class if current URL matches given segment
 *
 * @param  string $segment  URL segment to check e.g. 'homepage', 'faq'
 * @return string           'active' or ''
 */
if (!function_exists('cms_active')) {
    function cms_active(string $segment): string
    {
        $uri = service('uri');
        $currentPath = implode('/', $uri->getSegments());

        if (str_contains($currentPath, $segment)) {
            return 'active';
        }
        return '';
    }
}

// ============================================================
// JSON DECODE SAFE
// ============================================================
/**
 * Safely decode JSON — returns array even on failure
 *
 * @param  string|null $json
 * @return array
 */
if (!function_exists('cms_json_decode')) {
    function cms_json_decode($json): array
    {
        if (empty($json)) {
            return [];
        }
        // already an array — return as is
        if (is_array($json)) {
            return $json;
        }
        // object — convert to array
        if (is_object($json)) {
            return json_decode(json_encode($json), true);
        }
        // string — decode
        $decoded = json_decode($json, true);
        return is_array($decoded) ? $decoded : [];
    }
}

// ============================================================
// JSON ENCODE SAFE
// ============================================================
/**
 * Safely encode array to JSON
 *
 * @param  array $data
 * @return string
 */
if (!function_exists('cms_json_encode')) {
    function cms_json_encode(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

// ============================================================
// FLASH MESSAGE CHECK
// ============================================================
/**
 * Check if a flash message exists
 *
 * @param  string $key  'success' | 'error' | 'warning' | 'info'
 * @return bool
 */
if (!function_exists('cms_has_flash')) {
    function cms_has_flash(string $key): bool
    {
        return !empty(session()->getFlashdata($key));
    }
}

// ============================================================
// GET SETTING VALUE
// ============================================================
/**
 * Get a setting value from settings table by key
 * Use this in views/controllers to fetch site settings
 *
 * @param  string $key
 * @param  string $default
 * @return string
 */
if (!function_exists('cms_setting')) {
    function cms_setting(string $key, string $default = ''): string
    {
        static $settings = null;

        if ($settings === null) {
            $db       = \Config\Database::connect();
            $rows     = $db->table('settings')->get()->getResultArray();
            $settings = [];
            foreach ($rows as $row) {
                $settings[$row['key']] = $row['value'];
            }
        }

        return $settings[$key] ?? $default;
    }
}
