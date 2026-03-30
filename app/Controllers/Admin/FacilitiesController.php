<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\FacilitiesModel;
use App\Models\Admin\AboutContentModel;


class FacilitiesController extends BaseController
{
    protected $facilitiesModel;
    protected $aboutModel;

    public function __construct()
    {
        $this->facilitiesModel = new FacilitiesModel();
        $this->aboutModel      = new AboutContentModel();
        helper(['url', 'form', 'cms']);
    }

    // ── List all facilities ───────────────────────────────
    public function index()
    {
        $d = $this->aboutModel->getAllKeyed();

        // dynamically find all highlights
        $highlights = [];
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["facilities_highlight_{$i}_heading"])) {
                $highlights[$i] = [
                    'icon'        => $d["facilities_highlight_{$i}_icon"]['heading']            ?? 'fas fa-star',
                    'heading'     => $d["facilities_highlight_{$i}_heading"]['heading']         ?? '',
                    'description' => $d["facilities_highlight_{$i}_description"]['description'] ?? '',
                ];
            }
        }

        // minimum 2 always
        for ($i = 1; $i <= 2; $i++) {
            if (!isset($highlights[$i])) {
                $highlights[$i] = [
                    'icon'        => $i == 1 ? 'fas fa-person-booth' : 'fas fa-bowl-food',
                    'heading'     => '',
                    'description' => '',
                ];
            }
        }

        $data = [
            'pageTitle'  => 'Facilities',
            'facilities' => $this->facilitiesModel->orderBy('sort_order', 'ASC')->findAll(),
            'highlights' => $highlights,
        ];
        return view('admin/facilities/index', $data);
    }

    public function addHighlight()
    {
        $d = $this->aboutModel->getAllKeyed();

        // find next highlight number
        $next = 1;
        for ($i = 1; $i <= 20; $i++) {
            if (isset($d["facilities_highlight_{$i}_heading"])) {
                $next = $i + 1;
            }
        }

        // insert empty slots
        $this->aboutModel->upsert("facilities_highlight_{$next}_icon",        ['heading' => 'fas fa-star',  'description' => '', 'image' => '']);
        $this->aboutModel->upsert("facilities_highlight_{$next}_heading",     ['heading' => '',             'description' => '', 'image' => '']);
        $this->aboutModel->upsert("facilities_highlight_{$next}_description", ['heading' => '',             'description' => '',  'image' => '']);

        return redirect()->to(base_url('admin/facilities') . '#highlights')
            ->with('success', 'New highlight slot added.');
    }

    public function deleteHighlight($num)
    {
        $keys = [
            "facilities_highlight_{$num}_icon",
            "facilities_highlight_{$num}_heading",
            "facilities_highlight_{$num}_description",
        ];

        foreach ($keys as $key) {
            $row = $this->aboutModel->where('section_key', $key)->first();
            if ($row) {
                $this->aboutModel->delete($row['id']);
            }
        }

        return redirect()->to(base_url('admin/facilities') . '#highlights')
            ->with('success', 'Highlight removed.');
    }

    public function updateHighlight()
    {
        $num  = $this->request->getPost('highlight_num');
        $icon = $this->request->getPost('icon');
        $heading     = $this->request->getPost('heading');
        $description = $this->request->getPost('description');

        $this->aboutModel->upsert("facilities_highlight_{$num}_icon",        ['heading' => $icon,        'description' => '', 'image' => '']);
        $this->aboutModel->upsert("facilities_highlight_{$num}_heading",     ['heading' => $heading,     'description' => '', 'image' => '']);
        $this->aboutModel->upsert("facilities_highlight_{$num}_description", ['heading' => '',           'description' => $description, 'image' => '']);

        return redirect()->to(base_url('admin/facilities') . '#highlights')
            ->with('success', 'Highlight updated successfully.');
    }

    // ── Show add form ─────────────────────────────────────
    public function add()
    {
        $data = [
            'pageTitle' => 'Add Facility',
            'facility'  => null,
        ];
        return view('admin/facilities/form', $data);
    }

    // ── Store new facility ────────────────────────────────
    public function store()
    {
        $rules = [
            'title'    => 'required|max_length[150]',
            'icon'     => 'required|max_length[100]',
            'badge'    => 'required|max_length[150]',
            'badge_icon' => 'required|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // build features JSON from posted arrays
        $featureIcons = $this->request->getPost('feature_icon') ?? [];
        $featureTexts = $this->request->getPost('feature_text') ?? [];
        $features     = [];

        for ($i = 0; $i < 3; $i++) {
            $features[] = [
                'icon' => $featureIcons[$i] ?? '',
                'text' => $featureTexts[$i] ?? '',
            ];
        }

        $this->facilitiesModel->insert([
            'title'      => $this->request->getPost('title'),
            'icon'       => $this->request->getPost('icon'),
            'badge'      => $this->request->getPost('badge'),
            'badge_icon' => $this->request->getPost('badge_icon'),
            'features'   => json_encode($features),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'status'     => $this->request->getPost('status') ?? 1,
        ]);

        return redirect()->to(base_url('admin/facilities'))
            ->with('success', 'Facility added successfully.');
    }

    // ── Show edit form ────────────────────────────────────
    public function edit($id)
    {
        $facility = $this->facilitiesModel->find($id);
        if (!$facility) {
            return redirect()->to(base_url('admin/facilities'))
                ->with('error', 'Facility not found.');
        }

        // decode features JSON
        $facility['features'] = cms_json_decode($facility['features']);

        $data = [
            'pageTitle' => 'Edit Facility',
            'facility'  => $facility,
        ];
        return view('admin/facilities/form', $data);
    }

    // ── Update facility ───────────────────────────────────
    public function update($id)
    {
        $facility = $this->facilitiesModel->find($id);
        if (!$facility) {
            return redirect()->to(base_url('admin/facilities'))
                ->with('error', 'Facility not found.');
        }

        $rules = [
            'title'      => 'required|max_length[150]',
            'icon'       => 'required|max_length[100]',
            'badge'      => 'required|max_length[150]',
            'badge_icon' => 'required|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // build features JSON
        $featureIcons = $this->request->getPost('feature_icon') ?? [];
        $featureTexts = $this->request->getPost('feature_text') ?? [];
        $features     = [];

        for ($i = 0; $i < 3; $i++) {
            $features[] = [
                'icon' => $featureIcons[$i] ?? '',
                'text' => $featureTexts[$i] ?? '',
            ];
        }

        $this->facilitiesModel->update($id, [
            'title'      => $this->request->getPost('title'),
            'icon'       => $this->request->getPost('icon'),
            'badge'      => $this->request->getPost('badge'),
            'badge_icon' => $this->request->getPost('badge_icon'),
            'features'   => json_encode($features),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'status'     => $this->request->getPost('status') ?? 1,
        ]);

        return redirect()->to(base_url('admin/facilities'))
            ->with('success', 'Facility updated successfully.');
    }

    // ── Delete facility ───────────────────────────────────
    public function delete($id)
    {
        $facility = $this->facilitiesModel->find($id);
        if (!$facility) {
            return redirect()->to(base_url('admin/facilities'))
                ->with('error', 'Facility not found.');
        }

        $this->facilitiesModel->delete($id);

        return redirect()->to(base_url('admin/facilities'))
            ->with('success', 'Facility deleted successfully.');
    }

    // ── Sort order (AJAX) ─────────────────────────────────
    public function sort()
    {
        $order = $this->request->getPost('order');
        if (is_array($order)) {
            foreach ($order as $sort => $id) {
                $this->facilitiesModel->update($id, ['sort_order' => $sort]);
            }
        }
        return $this->response->setJSON(['success' => true]);
    }

    // ── Toggle status (AJAX) ──────────────────────────────
    public function toggleStatus($id)
    {
        $facility = $this->facilitiesModel->find($id);
        if (!$facility) {
            return $this->response->setJSON(['success' => false]);
        }

        $newStatus = $facility['status'] == 1 ? 0 : 1;
        $this->facilitiesModel->update($id, ['status' => $newStatus]);

        return $this->response->setJSON([
            'success' => true,
            'status'  => $newStatus,
        ]);
    }
}
