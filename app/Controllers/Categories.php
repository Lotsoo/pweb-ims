<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Categories extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data['categories'] = $this->categoryModel->findAll();
        return view('categories/index', $data);
    }

    public function create()
    {
        return view('categories/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'description' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/categories')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $data['category'] = $this->categoryModel->find($id);
        if (empty($data['category'])) {
            return redirect()->to('/categories')->with('error', 'Category not found');
        }
        return view('categories/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'description' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
             return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/categories')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/categories')->with('success', 'Category deleted successfully');
    }
}
