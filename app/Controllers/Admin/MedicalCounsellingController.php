<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MedicalCounsellingModel;

class MedicalCounsellingController extends BaseController
{
    protected $medicalModel;

    public function __construct()
    {
        helper(['form', 'url', 'cms']);
        $this->medicalModel = new MedicalCounsellingModel();
    }

    public function index()
    {
        $data['medical'] = $this->medicalModel->first();

        return view('admin/medical-counselling/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'caption' => $this->request->getPost('caption'),
            'campus' => $this->request->getPost('campus'),
        ];

        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $old = $this->medicalModel->find($id);

            if (!empty($old['image'])) {
                cms_delete_file('medical-counselling/' . $old['image']);
            }

            $newName = cms_upload($file, 'medical-counselling');
            $data['image'] = $newName;
        }

        $this->medicalModel->update($id, $data);

        return redirect()->back()->with('success', 'Medical Counselling updated successfully');
    }
}