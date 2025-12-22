<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->select('products.*, categories.name as category_name')
                                             ->join('categories', 'categories.id = products.category_id')
                                             ->findAll();
        $data['categories'] = $this->categoryModel->findAll();
        return view('products/index', $data);
    }

    public function create()
    {
        $data['categories'] = $this->categoryModel->findAll();
        return view('products/create', $data);
    }

    public function store()
    {
        $rules = [
            'category_id' => 'required|is_not_unique[categories.id]',
            'name' => 'required|min_length[3]|max_length[100]',
            'sku' => 'required|min_length[3]|max_length[50]|is_unique[products.sku]',
            'price' => 'required|numeric',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('image');
        $newName = $img->getRandomName();
        $img->move('uploads/products', $newName);

        $this->productModel->save([
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'sku' => $this->request->getPost('sku'),
            'stock_quantity' => 0, // Initial stock is 0
            'price' => $this->request->getPost('price'),
            'image' => $newName
        ]);

        return redirect()->to('/products')->with('success', 'Product created successfully');
    }

    public function show($id)
    {
        $data['product'] = $this->productModel->select('products.*, categories.name as category_name')
                                             ->join('categories', 'categories.id = products.category_id')
                                             ->where('products.id', $id)
                                             ->first();
        
        if (empty($data['product'])) {
            return redirect()->to('/products')->with('error', 'Product not found');
        }
        
        return view('products/show', $data);
    }

    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        if (empty($data['product'])) {
            return redirect()->to('/products')->with('error', 'Product not found');
        }
        $data['categories'] = $this->categoryModel->findAll();
        return view('products/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'category_id' => 'required|is_not_unique[categories.id]',
            'name' => 'required|min_length[3]|max_length[100]',
            'sku' => "required|min_length[3]|max_length[50]|is_unique[products.sku,id,{$id}]",
            'price' => 'required|numeric',
            'image' => 'permit_empty|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'sku' => $this->request->getPost('sku'),
            'price' => $this->request->getPost('price'),
        ];

        $img = $this->request->getFile('image');
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move('uploads/products', $newName);
            $data['image'] = $newName;
            
            // Delete old image
            $oldProduct = $this->productModel->find($id);
            if ($oldProduct['image'] && file_exists('uploads/products/' . $oldProduct['image'])) {
                unlink('uploads/products/' . $oldProduct['image']);
            }
        }

        $this->productModel->update($id, $data);

        return redirect()->to('/products')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if ($product['image'] && file_exists('uploads/products/' . $product['image'])) {
            unlink('uploads/products/' . $product['image']);
        }
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Product deleted successfully');
    }
}
