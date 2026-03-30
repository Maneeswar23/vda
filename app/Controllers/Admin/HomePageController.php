<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HomeBannerModel;
use App\Models\Admin\HomeStatsModel;
use App\Models\Admin\HomeAboutModel;
use App\Models\Admin\HomepageSelectionCardModel;

class HomePageController extends BaseController
{
    protected $bannerModel;
    protected $statsModel;
    protected $aboutModel;

    public function __construct()
    {
        $this->bannerModel = new HomeBannerModel();
        $this->statsModel  = new HomeStatsModel();
        $this->aboutModel  = new HomeAboutModel();
        helper(['url', 'form', 'cms']);
    }

    // ── Dashboard index ───────────────────────────────────
    public function index()
    {
        $data = [
            'title'   => 'Homepage Management',
            'banners' => $this->bannerModel->orderBy('sort_order', 'ASC')->findAll(),
            'stats'   => $this->statsModel->orderBy('sort_order', 'ASC')->findAll(),
            'about'   => $this->aboutModel->first(),
            'selectionCards' => (new HomepageSelectionCardModel())->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/homepage/index', $data);
    }

    // ====================================================
    // BANNERS
    // ====================================================

    public function banners()
    {
        $data = [
            'title'   => 'Manage Banners',
            'banners' => $this->bannerModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/homepage/banners', $data);
    }

    public function bannerAdd()
    {
        $data = ['title' => 'Add Banner', 'banner' => null];
        return view('admin/homepage/banner-form', $data);
    }

    public function bannerStore()
    {
        $rules = [
            'title'       => 'required|max_length[255]',
            'button_text' => 'permit_empty|max_length[100]',
            'button_link' => 'permit_empty|max_length[255]',
            'sort_order'  => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = '';
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $image = cms_upload($file, 'banners');
            }
        }

        $this->bannerModel->insert([
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'image'       => $image,
            'sort_order'  => $this->request->getPost('sort_order') ?? 0,
            'status'      => $this->request->getPost('status') ?? 1,
        ]);

        return redirect()->to(base_url('admin/homepage/banners'))->with('success', 'Banner added successfully.');
    }

    public function bannerEdit($id)
    {
        $banner = $this->bannerModel->find($id);
        if (!$banner) {
            return redirect()->to(base_url('admin/homepage/banners'))->with('error', 'Banner not found.');
        }
        $data = ['title' => 'Edit Banner', 'banner' => $banner];
        return view('admin/homepage/banner-form', $data);
    }

    public function bannerUpdate($id)
    {
        $banner = $this->bannerModel->find($id);
        if (!$banner) {
            return redirect()->to(base_url('admin/homepage/banners'))->with('error', 'Banner not found.');
        }

        $rules = [
            'title'       => 'required|max_length[255]',
            'button_text' => 'permit_empty|max_length[100]',
            'button_link' => 'permit_empty|max_length[255]',
            'sort_order'  => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $banner['image'];
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                // delete old image
                if (!empty($banner['image'])) {
                    cms_delete_file('banners/' . $banner['image']);
                }
                $image = cms_upload($file, 'banners');
            }
        }

        $this->bannerModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'image'       => $image,
            'sort_order'  => $this->request->getPost('sort_order') ?? 0,
            'status'      => $this->request->getPost('status') ?? 1,
        ]);

        return redirect()->to(base_url('admin/homepage/banners'))->with('success', 'Banner updated successfully.');
    }

    public function bannerDelete($id)
    {
        $banner = $this->bannerModel->find($id);
        if (!$banner) {
            return redirect()->to(base_url('admin/homepage/banners'))->with('error', 'Banner not found.');
        }

        if (!empty($banner['image'])) {
            cms_delete_file('banners/' . $banner['image']);
        }

        $this->bannerModel->delete($id);
        return redirect()->to(base_url('admin/homepage/banners'))->with('success', 'Banner deleted successfully.');
    }

    public function bannerSort()
    {
        $orders = $this->request->getPost('order');
        if (is_array($orders)) {
            foreach ($orders as $sort => $id) {
                $this->bannerModel->update($id, ['sort_order' => $sort]);
            }
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    // ====================================================
    // STATS
    // ====================================================

    public function stats()
    {
        $data = [
            'title' => 'Manage Stats',
            'stats' => $this->statsModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/homepage/stats', $data);
    }

    public function statsStore()
    {
        $rules = [
            'number' => 'required|max_length[50]',
            'label'  => 'required|max_length[100]',
            'icon'   => 'permit_empty|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');

        if ($id) {
            // update existing
            $this->statsModel->update($id, [
                'number'     => $this->request->getPost('number'),
                'label'      => $this->request->getPost('label'),
                'icon'       => $this->request->getPost('icon'),
                'sort_order' => $this->request->getPost('sort_order') ?? 0,
            ]);
            return redirect()->to(base_url('admin/homepage/stats'))->with('success', 'Stat updated successfully.');
        }

        $this->statsModel->insert([
            'number'     => $this->request->getPost('number'),
            'label'      => $this->request->getPost('label'),
            'icon'       => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ]);

        return redirect()->to(base_url('admin/homepage/stats'))->with('success', 'Stat added successfully.');
    }

    public function statsDelete($id)
    {
        $this->statsModel->delete($id);
        return redirect()->to(base_url('admin/homepage/stats'))->with('success', 'Stat deleted successfully.');
    }

    // ====================================================
    // ABOUT SECTION
    // ====================================================

    public function about()
    {
        $data = [
            'title' => 'Homepage About Section',
            'about' => $this->aboutModel->first(),
        ];
        return view('admin/homepage/about', $data);
    }

    public function aboutUpdate()
    {
        $rules = [
            'heading'     => 'required|max_length[255]',
            'subheading'  => 'permit_empty|max_length[255]',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $about = $this->aboutModel->first();

        $image = $about['image'] ?? '';
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                if (!empty($about['image'])) {
                    cms_delete_file('about/' . $about['image']);
                }
                $image = cms_upload($file, 'about');
            }
        }

        $updateData = [
            'heading'     => $this->request->getPost('heading'),
            'subheading'  => $this->request->getPost('subheading'),
            'description' => $this->request->getPost('description'),
            'image'       => $image,
        ];

        if ($about) {
            $this->aboutModel->update($about['id'], $updateData);
        } else {
            $this->aboutModel->insert($updateData);
        }

        return redirect()->to(base_url('admin/homepage/about'))->with('success', 'About section updated successfully.');
    }
}
