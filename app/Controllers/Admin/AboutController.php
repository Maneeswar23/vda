<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AboutContentModel;

class AboutController extends BaseController
{
    protected $aboutModel;

    public function __construct()
    {
        $this->aboutModel = new AboutContentModel();
        helper(['url', 'form', 'cms']);
    }

    // ── index ─────────────────────────────────────────────
    public function index()
    {
        $d = $this->aboutModel->getAllKeyed();

        // count directors
        $dirCount = 0;
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["director_{$i}_name"])) {
                $dirCount = $i;
            }
        }
        if ($dirCount < 2) $dirCount = 2;

        // count team
        $teamCount = 0;
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["team_{$i}_name"])) {
                $teamCount = $i;
            }
        }
        if ($teamCount < 4) $teamCount = 4;

        return view('admin/about/index', [
            'pageTitle' => 'About Page',
            'd'         => $d,
            'dirCount'  => $dirCount,
            'teamCount' => $teamCount,
        ]);
    }

    // ── update ────────────────────────────────────────────
    public function update($sectionKey)
    {
        $post = $this->request->getPost();
        unset($post['csrf_test_name']);

        // ── 1. Multi-key grouped forms ───────────────────
        $multiMaps = [
            'about_multi' => [
                'about_main_title'  => 'about_main_title',
                'about_subtitle'    => 'about_subtitle',
                'about_text'        => 'about_text',
                'about_description' => 'about_description',
            ],
            'our_section_multi' => [
                'our_section_title'    => 'our_section_title',
                'our_section_subtitle' => 'our_section_subtitle',
            ],
            'mission_multi' => [
                'mission_title'       => 'mission_title',
                'mission_subtitle'    => 'mission_subtitle',
                'mission_description' => 'mission_description',
            ],
            'vision_multi' => [
                'vision_title'       => 'vision_title',
                'vision_description' => 'vision_description',
            ],
            'team_titles' => [
                'team_title'    => 'team_title',
                'team_subtitle' => 'team_subtitle',
            ],
            'director_section_multi' => [
                'director_title'    => 'director_title',
                'director_subtitle' => 'director_subtitle',
            ],
        ];

        if (isset($multiMaps[$sectionKey])) {
            foreach ($multiMaps[$sectionKey] as $dbKey => $postKey) {
                $this->aboutModel->upsert($dbKey, [
                    'heading'     => $post[$postKey] ?? '',
                    'description' => '',
                    'image'       => '',
                ]);
            }
            return redirect()->back()->with('success', 'Section updated successfully.');
        }

        // ── 2. Director image + details combined ─────────────
        if (preg_match('/^director_(\d+)_(image|details)$/', $sectionKey, $m)) {
            $n    = $m[1];
            $type = $m[2];

            if ($type === 'image') {
                $key      = "director_{$n}_image";
                $existing = $this->aboutModel->getSection($key);
                $image    = $existing['image'] ?? '';

                $file = $this->request->getFile('image');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    if (!empty($image)) {
                        cms_delete_file('about/' . $image);
                    }
                    $uploaded = cms_upload($file, 'about');
                    if ($uploaded) {
                        $image = $uploaded;
                    }
                }

                $this->aboutModel->upsert($key, [
                    'heading'     => '',
                    'description' => '',
                    'image'       => $image,
                ]);

                return redirect()->back()->with('success', 'Director photo updated.');
            }

            if ($type === 'details') {
                $imageKey  = "director_{$n}_image";
                $imageRow  = $this->aboutModel->getSection($imageKey);
                $imageName = $imageRow['image'] ?? '';

                $file = $this->request->getFile('image');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    if (!empty($imageName)) {
                        cms_delete_file('about/' . $imageName);
                    }
                    $uploaded = cms_upload($file, 'about');
                    if ($uploaded) {
                        $imageName = $uploaded;
                    }
                }

                $this->aboutModel->upsert($imageKey, [
                    'heading'     => '',
                    'description' => '',
                    'image'       => $imageName,
                ]);

                $textFields = [
                    "director_{$n}_name"        => $post['director_name']        ?? '',
                    "director_{$n}_designation" => $post['director_designation'] ?? '',
                    "director_{$n}_experience"  => $post['director_experience']  ?? '',
                    "director_{$n}_message"     => $post['director_message']     ?? '',
                ];
                foreach ($textFields as $key => $val) {
                    $this->aboutModel->upsert($key, [
                        'heading'     => $val,
                        'description' => '',
                        'image'       => '',
                    ]);
                }

                // description → description column
                $this->aboutModel->upsert("director_{$n}_description", [
                    'heading'     => '',
                    'description' => $post['director_description'] ?? '',
                    'image'       => '',
                ]);

                return redirect()->back()->with('success', 'Director details updated.');
            }
        }

        // ── 4. Team image + details combined ─────────────────
        if (preg_match('/^team_(\d+)_(image|details)$/', $sectionKey, $m)) {
            $n    = $m[1];
            $type = $m[2];

            if ($type === 'image') {
                $key      = "team_{$n}_image";
                $existing = $this->aboutModel->getSection($key);
                $image    = $existing['image'] ?? '';

                $file = $this->request->getFile('image');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    if (!empty($image)) {
                        cms_delete_file('about/' . $image);
                    }
                    $uploaded = cms_upload($file, 'about');
                    if ($uploaded) {
                        $image = $uploaded;
                    }
                }

                $this->aboutModel->upsert($key, [
                    'heading'     => '',
                    'description' => '',
                    'image'       => $image,
                ]);

                return redirect()->back()->with('success', 'Team photo updated.');
            }

            if ($type === 'details') {
                $imageKey  = "team_{$n}_image";
                $imageRow  = $this->aboutModel->getSection($imageKey);
                $imageName = $imageRow['image'] ?? '';

                $file = $this->request->getFile('image');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    if (!empty($imageName)) {
                        cms_delete_file('about/' . $imageName);
                    }
                    $uploaded = cms_upload($file, 'about');
                    if ($uploaded) {
                        $imageName = $uploaded;
                    }
                }

                $this->aboutModel->upsert($imageKey, [
                    'heading'     => '',
                    'description' => '',
                    'image'       => $imageName,
                ]);

                $fields = [
                    "team_{$n}_name"        => $post['team_name']        ?? '',
                    "team_{$n}_designation" => $post['team_designation'] ?? '',
                ];
                foreach ($fields as $key => $val) {
                    $this->aboutModel->upsert($key, [
                        'heading'     => $val,
                        'description' => '',
                        'image'       => '',
                    ]);
                }

                return redirect()->back()->with('success', 'Team member updated.');
            }
        }

        // ── 6. Main image upload ──────────────────────────
        if ($sectionKey === 'main_image') {
            $existing = $this->aboutModel->getSection('main_image');
            $image    = $existing['image'] ?? '';

            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                if (!empty($image)) {
                    cms_delete_file('about/' . $image);
                }
                $uploaded = cms_upload($file, 'about');
                if ($uploaded) {
                    $image = $uploaded;
                }
            }

            $this->aboutModel->upsert('main_image', [
                'heading'     => '',
                'description' => '',
                'image'       => $image,
            ]);

            return redirect()->back()->with('success', 'Main image updated.');
        }

        // ── 7. About section image ────────────────────────
        if ($sectionKey === 'about_image') {
            $existing = $this->aboutModel->getSection('about_image');
            $image    = $existing['image'] ?? '';

            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                if (!empty($image)) {
                    cms_delete_file('about/' . $image);
                }
                $uploaded = cms_upload($file, 'about');
                if ($uploaded) {
                    $image = $uploaded;
                }
            }

            $this->aboutModel->upsert('about_image', [
                'heading'     => '',
                'description' => '',
                'image'       => $image,
            ]);

            return redirect()->back()->with('success', 'About image updated.');
        }


        // ── 8. Single key with heading/description ────────
        $file     = $this->request->getFile('image');
        $existing = $this->aboutModel->getSection($sectionKey);
        $image    = $existing['image'] ?? '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($image)) {
                cms_delete_file('about/' . $image);
            }
            $uploaded = cms_upload($file, 'about');
            if ($uploaded) {
                $image = $uploaded;
            }
        }

        $this->aboutModel->upsert($sectionKey, [
            'heading'     => $post['heading']     ?? '',
            'description' => $post['description'] ?? '',
            'image'       => $image,
        ]);

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    // ── Add director ──────────────────────────────────────
    public function addDirector()
    {
        $d    = $this->aboutModel->getAllKeyed();
        $next = 1;
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["director_{$i}_name"])) {
                $next = $i + 1;
            }
        }

        $suffixes = ['image', 'name', 'designation', 'experience', 'message', 'description'];
        foreach ($suffixes as $s) {
            $this->aboutModel->upsert("director_{$next}_{$s}", [
                'heading' => '',
                'description' => '',
                'image' => '',
            ]);
        }

        return redirect()->to(base_url('admin/about') . '#directors')
            ->with('success', 'New director slot added.');
    }

    // ── Delete director ───────────────────────────────────
    public function deleteDirector($num)
    {
        $suffixes = ['image', 'name', 'designation', 'experience', 'message', 'description'];
        foreach ($suffixes as $s) {
            $key = "director_{$num}_{$s}";
            $row = $this->aboutModel->where('section_key', $key)->first();
            if ($row) {
                if ($s === 'image' && !empty($row['image'])) {
                    cms_delete_file('about/' . $row['image']);
                }
                $this->aboutModel->delete($row['id']);
            }
        }

        return redirect()->to(base_url('admin/about') . '#directors')
            ->with('success', 'Director removed.');
    }

    // ── Add team member ───────────────────────────────────
    public function addTeam()
    {
        $d    = $this->aboutModel->getAllKeyed();
        $next = 1;
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["team_{$i}_name"])) {
                $next = $i + 1;
            }
        }

        $suffixes = ['image', 'name', 'designation'];
        foreach ($suffixes as $s) {
            $this->aboutModel->upsert("team_{$next}_{$s}", [
                'heading' => '',
                'description' => '',
                'image' => '',
            ]);
        }

        return redirect()->to(base_url('admin/about') . '#team')
            ->with('success', 'New team member slot added.');
    }

    // ── Delete team member ────────────────────────────────
    public function deleteTeam($num)
    {
        $suffixes = ['image', 'name', 'designation'];
        foreach ($suffixes as $s) {
            $key = "team_{$num}_{$s}";
            $row = $this->aboutModel->where('section_key', $key)->first();
            if ($row) {
                if ($s === 'image' && !empty($row['image'])) {
                    cms_delete_file('about/' . $row['image']);
                }
                $this->aboutModel->delete($row['id']);
            }
        }

        return redirect()->to(base_url('admin/about') . '#team')
            ->with('success', 'Team member removed.');
    }
}
