<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HomepageSelectionCardModel;

class HomepageSelectionCardController extends BaseController
{
    protected $cardModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->cardModel = new HomepageSelectionCardModel();
    }

    public function index()
    {
        return view('admin/homepage-selection-cards/index', [
            'pageTitle' => 'Homepage Selection Cards',
            'cards'     => $this->cardModel->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function add()
    {
        return view('admin/homepage-selection-cards/form', [
            'pageTitle' => 'Add Homepage Selection Card',
            'card'      => null,
        ]);
    }

    public function store()
    {
        $rules = [
            'title'       => 'required|max_length[255]',
            'count_value' => 'required|max_length[50]',
            'label'       => 'required|max_length[50]',
            'location'    => 'required|max_length[255]',
            'badge'       => 'permit_empty|max_length[50]',
            'sort_order'  => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->cardModel->insert([
            'title'       => $this->request->getPost('title'),
            'count_value' => $this->request->getPost('count_value'),
            'label'       => $this->request->getPost('label'),
            'location'    => $this->request->getPost('location'),
            'badge'       => $this->request->getPost('badge'),
            'sort_order'  => $this->request->getPost('sort_order') ?: 0,
            'status'      => $this->request->getPost('status') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/homepage-selection-cards'))->with('success', 'Selection card added successfully.');
    }

    public function edit($id)
    {
        $card = $this->cardModel->find($id);
        if (!$card) {
            return redirect()->to(base_url('admin/homepage-selection-cards'))->with('error', 'Selection card not found.');
        }

        return view('admin/homepage-selection-cards/form', [
            'pageTitle' => 'Edit Homepage Selection Card',
            'card'      => $card,
        ]);
    }

    public function update($id)
    {
        $card = $this->cardModel->find($id);
        if (!$card) {
            return redirect()->to(base_url('admin/homepage-selection-cards'))->with('error', 'Selection card not found.');
        }

        $rules = [
            'title'       => 'required|max_length[255]',
            'count_value' => 'required|max_length[50]',
            'label'       => 'required|max_length[50]',
            'location'    => 'required|max_length[255]',
            'badge'       => 'permit_empty|max_length[50]',
            'sort_order'  => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->cardModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'count_value' => $this->request->getPost('count_value'),
            'label'       => $this->request->getPost('label'),
            'location'    => $this->request->getPost('location'),
            'badge'       => $this->request->getPost('badge'),
            'sort_order'  => $this->request->getPost('sort_order') ?: 0,
            'status'      => $this->request->getPost('status') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/homepage-selection-cards'))->with('success', 'Selection card updated successfully.');
    }

    public function delete($id)
    {
        $card = $this->cardModel->find($id);
        if (!$card) {
            return redirect()->to(base_url('admin/homepage-selection-cards'))->with('error', 'Selection card not found.');
        }

        $this->cardModel->delete($id);

        return redirect()->to(base_url('admin/homepage-selection-cards'))->with('success', 'Selection card deleted successfully.');
    }
}
