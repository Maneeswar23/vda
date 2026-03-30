<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\EligibilityModel;

class EligibilityController extends BaseController
{
    protected $eligibilityModel;

    public function __construct()
    {
        helper(['form', 'url']);
        helper('cms');

        $this->eligibilityModel = new EligibilityModel();
    }

    public function index()
    {
        $data['eligibility'] = $this->eligibilityModel->first();

        return view('admin/eligibility/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'campus' => $this->request->getPost('campus'),
            'caption' => $this->request->getPost('caption'),
        ];

        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $old = $this->eligibilityModel->find($id);

            if (!empty($old['image'])) {
                \cms_delete_file('eligibility/' . $old['image']);
            }

            $newName = cms_upload($file, 'eligibility');
            $data['image'] = $newName;
        }

        $this->eligibilityModel->update($id, $data);

        return redirect()->back()->with('success', 'Eligibility updated successfully');
    }
}
