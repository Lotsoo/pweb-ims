<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\ProductModel;

class Transactions extends BaseController
{
    protected $transactionModel;
    protected $productModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['transactions'] = $this->transactionModel->select('transactions.*, products.name as product_name, users.username')
                                                     ->join('products', 'products.id = transactions.product_id')
                                                     ->join('users', 'users.id = transactions.user_id')
                                                     ->orderBy('created_at', 'DESC')
                                                     ->findAll();
        return view('transactions/index', $data);
    }

    public function create()
    {
        $data['products'] = $this->productModel->findAll();
        return view('transactions/create', $data);
    }

    public function store()
    {
        $rules = [
            'product_id' => 'required|is_not_unique[products.id]',
            'type' => 'required|in_list[in,out]',
            'quantity' => 'required|integer|greater_than[0]',
            'notes' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $type = $this->request->getPost('type');
        $quantity = $this->request->getPost('quantity');
        $productId = $this->request->getPost('product_id');

        // Check stock for 'out' transactions
        if ($type === 'out') {
            $product = $this->productModel->find($productId);
            if ($product['stock_quantity'] < $quantity) {
                 return redirect()->back()->withInput()->with('error', 'Insufficient stock for this transaction.');
            }
        }

        // Create transaction
        $this->transactionModel->save([
            'product_id' => $productId,
            'user_id' => session()->get('id'),
            'type' => $type,
            'quantity' => $quantity,
            'notes' => $this->request->getPost('notes'),
        ]);

        // Update product stock
        $product = $this->productModel->find($productId);
        $newStock = ($type === 'in') ? $product['stock_quantity'] + $quantity : $product['stock_quantity'] - $quantity;
        
        $this->productModel->update($productId, ['stock_quantity' => $newStock]);

        return redirect()->to('/transactions')->with('success', 'Transaction recorded successfully');
    }

    public function edit($id)
    {
        $data['transaction'] = $this->transactionModel->find($id);
        
        if (empty($data['transaction'])) {
            return redirect()->to('/transactions')->with('error', 'Transaction not found');
        }

        $data['products'] = $this->productModel->findAll();
        return view('transactions/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'product_id' => 'required', // Allow same product
            'type' => 'required|in_list[in,out]',
            'quantity' => 'required|integer|greater_than[0]',
            'notes' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
             return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $oldTransaction = $this->transactionModel->find($id);
        if (!$oldTransaction) {
            return redirect()->to('/transactions')->with('error', 'Transaction not found');
        }

        $newType = $this->request->getPost('type');
        $newQuantity = $this->request->getPost('quantity');
        $newProductId = $this->request->getPost('product_id');

        // 1. Revert Old Transaction Effect
        $product = $this->productModel->find($oldTransaction['product_id']);
        $revertedStock = ($oldTransaction['type'] === 'in') ? $product['stock_quantity'] - $oldTransaction['quantity'] : $product['stock_quantity'] + $oldTransaction['quantity'];
        
        // If product changed, we update the old product's stock first
        if ($oldTransaction['product_id'] != $newProductId) {
             $this->productModel->update($oldTransaction['product_id'], ['stock_quantity' => $revertedStock]);
             // Fetch new product to apply new transaction
             $product = $this->productModel->find($newProductId);
             $revertedStock = $product['stock_quantity']; 
        }

        // 2. Validate New Stock Requirement (for 'out')
        if ($newType === 'out') {
            if ($revertedStock < $newQuantity) {
                 return redirect()->back()->withInput()->with('error', 'Insufficient stock for this modification.');
            }
        }

        // 3. Apply New Transaction Effect
        $finalStock = ($newType === 'in') ? $revertedStock + $newQuantity : $revertedStock - $newQuantity;

        // 4. Update Database
        $this->productModel->update($newProductId, ['stock_quantity' => $finalStock]); // Note: If product changed, this updates the new product. If not, it updates the same product with calculated final stock.
        
        // If product ID didn't change, the above update call handles it correctly using $finalStock derived from $revertedStock.
        // If product ID DID change:
        // - We already updated the OLD product with $revertedStock (line 86).
        // - We fetched the NEW product (line 88).
        // - $revertedStock became NEW product's current stock (line 89).
        // - $finalStock is NEW product's stock + effect (line 99).
        // - We update NEW product (line 102).
        
        $this->transactionModel->update($id, [
            'product_id' => $newProductId,
            'type' => $newType,
            'quantity' => $newQuantity,
            'notes' => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/transactions')->with('success', 'Transaction updated successfully');
    }

    public function delete($id)
    {
        $transaction = $this->transactionModel->find($id);
        if (!$transaction) {
            return redirect()->to('/transactions')->with('error', 'Transaction not found');
        }

        // Revert Stock
        $product = $this->productModel->find($transaction['product_id']);
        if ($product) {
            $newStock = ($transaction['type'] === 'in') ? $product['stock_quantity'] - $transaction['quantity'] : $product['stock_quantity'] + $transaction['quantity'];
            $this->productModel->update($transaction['product_id'], ['stock_quantity' => $newStock]);
        }

        $this->transactionModel->delete($id);

        return redirect()->to('/transactions')->with('success', 'Transaction deleted successfully');
    }
}
