<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $transactionModel = new TransactionModel();

        $data = [
            'total_products' => $productModel->countAll(),
            'total_stock' => $productModel->selectSum('stock_quantity')->first()['stock_quantity'] ?? 0,
            'low_stock' => $productModel->where('stock_quantity <', 10)->countAllResults(),
            'recent_transactions' => $transactionModel->select('transactions.*, products.name as product_name, users.username')
                                        ->join('products', 'products.id = transactions.product_id')
                                        ->join('users', 'users.id = transactions.user_id')
                                        ->orderBy('transactions.created_at', 'DESC')
                                        ->limit(5)
                                        ->find()
        ];

        return view('dashboard/index', $data);
    }
}
