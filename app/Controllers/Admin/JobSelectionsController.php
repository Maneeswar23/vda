<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JobSelectionsModel;

class JobSelectionsController extends BaseController
{
    protected $jobModel;

    public function __construct()
    {
        helper(['form', 'url', 'cms']);
        $this->jobModel = new JobSelectionsModel();
    }

    public function index()
    {
        $data['job'] = $this->jobModel->first();

        return view('admin/job-selections/index', $data);
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
            $old = $this->jobModel->find($id);

            if (!empty($old['image'])) {
                cms_delete_file('job-selections/' . $old['image']);
            }

            $newName = cms_upload($file, 'job-selections');
            $data['image'] = $newName;
        }

        $this->jobModel->update($id, $data);

        return redirect()->back()->with('success', 'Job Selections updated successfully');
    }
}