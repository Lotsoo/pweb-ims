<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\ProductModel;
use App\Models\TransactionDetailModel;

class Transactions extends BaseController
{
    protected $transactionModel;
    protected $productModel;
    protected $transactionDetailModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
        $this->transactionDetailModel = new TransactionDetailModel();
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

        $db = \Config\Database::connect();
        $db->transStart();

        $type = $this->request->getPost('type');
        $quantity = $this->request->getPost('quantity');
        $productId = $this->request->getPost('product_id');

        // cek stok product
        if ($type === 'out') {
            $product = $this->productModel->find($productId);
            if ($product['stock_quantity'] < $quantity) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'Insufficient stock for this transaction.');
            }
        }

        // simpan transaksi
        $this->transactionModel->save([
            'product_id' => $productId,
            'user_id' => session()->get('id'),
            'type' => $type,
            'quantity' => $quantity,
            'notes' => $this->request->getPost('notes'),
        ]);

        $transactionId = $this->transactionModel->getInsertID();

        // simpan transaksi detail
        $this->transactionDetailModel->save([
            'transaction_id' => $transactionId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'notes' => $this->request->getPost('notes'),
        ]);

        // update stok product
        $product = $this->productModel->find($productId);
        $newStock = ($type === 'in') ? $product['stock_quantity'] + $quantity : $product['stock_quantity'] - $quantity;

        $this->productModel->update($productId, ['stock_quantity' => $newStock]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Failed to save transaction.');
        }

        return redirect()->to('/transactions')->with('success', 'Transaction recorded successfully');
    }

    public function show($id)
    {
        $transaction = $this->transactionModel->select('transactions.*, users.username')
            ->join('users', 'users.id = transactions.user_id')
            ->find($id);

        if (!$transaction) {
            return redirect()->to('/transactions')->with('error', 'Transaction not found');
        }

        $details = $this->transactionDetailModel->select('transaction_details.*, products.name as product_name, products.sku as product_sku, products.image as product_image')
            ->join('products', 'products.id = transaction_details.product_id')
            ->where('transaction_id', $id)
            ->findAll();

        $data = [
            'transaction' => $transaction,
            'details' => $details
        ];

        return view('transactions/show', $data);
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
            'product_id' => 'required', 
            'type' => 'required|in_list[in,out]',
            'quantity' => 'required|integer|greater_than[0]',
            'notes' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $oldTransaction = $this->transactionModel->find($id);
        if (!$oldTransaction) {
            $db->transRollback();
            return redirect()->to('/transactions')->with('error', 'Transaction not found');
        }

        $newType = $this->request->getPost('type');
        $newQuantity = $this->request->getPost('quantity');
        $newProductId = $this->request->getPost('product_id');

        // Kembalikan Efek Transaksi Lama
        $product = $this->productModel->find($oldTransaction['product_id']);
        if (!$product) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Product not found for revert.');
        }

        $revertedStock = ($oldTransaction['type'] === 'in') ? $product['stock_quantity'] - $oldTransaction['quantity'] : $product['stock_quantity'] + $oldTransaction['quantity'];

        // Jika produk berubah, update stok produk lama terlebih dahulu
        if ($oldTransaction['product_id'] != $newProductId) {
            $this->productModel->update($oldTransaction['product_id'], ['stock_quantity' => $revertedStock]);
            // Ambil produk baru untuk menerapkan transaksi baru
            $product = $this->productModel->find($newProductId);
            if (!$product) {
                 $db->transRollback();
                 return redirect()->back()->withInput()->with('error', 'New product not found.');
            }
            $revertedStock = $product['stock_quantity'];
        }

        // 2. Validasi Persyaratan Stok Baru (untuk 'out')
        if ($newType === 'out') {
            if ($revertedStock < $newQuantity) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'Insufficient stock for this modification.');
            }
        }

        // 3. Terapkan Efek Transaksi Baru
        $finalStock = ($newType === 'in') ? $revertedStock + $newQuantity : $revertedStock - $newQuantity;

        // 4. Update Database
        $this->productModel->update($newProductId, ['stock_quantity' => $finalStock]);

        $this->transactionModel->update($id, [
            'product_id' => $newProductId,
            'type' => $newType,
            'quantity' => $newQuantity,
            'notes' => $this->request->getPost('notes'),
        ]);

        // Update transaction detail (assuming 1:1 mapping for now)
        // Cari detail yang terkait dengan transaksi ini
        $detail = $this->transactionDetailModel->where('transaction_id', $id)->first();
        if ($detail) {
            $this->transactionDetailModel->update($detail['id'], [
                'product_id' => $newProductId,
                'quantity' => $newQuantity,
                'notes' => $this->request->getPost('notes'),
            ]);
        } else {
             // Jika tidak ada detail (data legacy?), buat detail baru
             $this->transactionDetailModel->save([
                'transaction_id' => $id,
                'product_id' => $newProductId,
                'quantity' => $newQuantity,
                'notes' => $this->request->getPost('notes'),
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
             return redirect()->back()->withInput()->with('error', 'Failed to update transaction.');
        }

        return redirect()->to('/transactions')->with('success', 'Transaction updated successfully');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $transaction = $this->transactionModel->find($id);
        if (!$transaction) {
            $db->transRollback();
            return redirect()->to('/transactions')->with('error', 'Transaction not found');
        }

        // Kembalikan Efek Transaksi ke Stok Produk
        $product = $this->productModel->find($transaction['product_id']);
        if ($product) {
            $newStock = ($transaction['type'] === 'in') ? $product['stock_quantity'] - $transaction['quantity'] : $product['stock_quantity'] + $transaction['quantity'];
            $this->productModel->update($transaction['product_id'], ['stock_quantity' => $newStock]);
        }

        // Delete details first (if not cascaded)
        $this->transactionDetailModel->where('transaction_id', $id)->delete();
        
        // Hapus transaksi
        $this->transactionModel->delete($id);

        $db->transComplete();

        if ($db->transStatus() === false) {
             return redirect()->to('/transactions')->with('error', 'Failed to delete transaction.');
        }

        return redirect()->to('/transactions')->with('success', 'Transaction deleted successfully');
    }
}
