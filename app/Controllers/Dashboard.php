<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\CategoryModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $transactionModel = new TransactionModel();
        $categoryModel = new CategoryModel();

        // Basic Stats
        $totalProducts = $productModel->countAll();
        $totalCategories = $categoryModel->countAll();
        $totalStock = $productModel->selectSum('stock_quantity')->first()['stock_quantity'] ?? 0;
        
        // Low Stock (Threshold < 10)
        $lowStockCount = $productModel->where('stock_quantity <', 10)->countAllResults();
        $lowStockItems = $productModel->select('products.*, categories.name as category_name')
                                      ->join('categories', 'categories.id = products.category_id', 'left')
                                      ->where('stock_quantity <', 10)
                                      ->limit(5)
                                      ->find();

        // Recent Transactions
        $recentTransactions = $transactionModel->select('transactions.*, products.name as product_name, users.username')
                                        ->join('products', 'products.id = transactions.product_id')
                                        ->join('users', 'users.id = transactions.user_id')
                                        ->orderBy('transactions.created_at', 'DESC')
                                        ->limit(5)
                                        ->find();

        // Stock In/Out Weekly Stats (This week)
        $startOfWeek = date('Y-m-d 00:00:00', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d 23:59:59', strtotime('sunday this week'));

        $stockInWeekly = $transactionModel->where('type', 'in')
                                          ->where('created_at >=', $startOfWeek)
                                          ->where('created_at <=', $endOfWeek)
                                          ->selectSum('quantity')
                                          ->first()['quantity'] ?? 0;
                                          
        $stockOutWeekly = $transactionModel->where('type', 'out')
                                           ->where('created_at >=', $startOfWeek)
                                           ->where('created_at <=', $endOfWeek)
                                           ->selectSum('quantity')
                                           ->first()['quantity'] ?? 0;

        // Chart Data - Last 7 Days
        $chartLabels = [];
        $chartStockIn = [];
        $chartStockOut = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $chartLabels[] = date('D', strtotime($date)); // Mon, Tue, etc.
            
            $in = $transactionModel->where('type', 'in')
                                   ->like('created_at', $date)
                                   ->selectSum('quantity')
                                   ->first()['quantity'] ?? 0;
            $chartStockIn[] = $in;

            $out = $transactionModel->where('type', 'out')
                                    ->like('created_at', $date)
                                    ->selectSum('quantity')
                                    ->first()['quantity'] ?? 0;
            $chartStockOut[] = $out;
        }

        // Category Chart Data
        $categoryStats = $productModel->select('categories.name, COUNT(products.id) as count')
                                      ->join('categories', 'categories.id = products.category_id')
                                      ->groupBy('categories.id')
                                      ->findAll();
        
        $catLabels = [];
        $catData = [];
        foreach($categoryStats as $stat) {
            $catLabels[] = $stat['name'];
            $catData[] = $stat['count'];
        }

        $data = [
            'total_products' => $totalProducts,
            'total_categories' => $totalCategories,
            'total_stock' => $totalStock,
            'low_stock' => $lowStockCount,
            'low_stock_items' => $lowStockItems,
            'recent_transactions' => $recentTransactions,
            'stock_in_weekly' => $stockInWeekly,
            'stock_out_weekly' => $stockOutWeekly,
            'chart_labels' => json_encode($chartLabels),
            'chart_stock_in' => json_encode($chartStockIn),
            'chart_stock_out' => json_encode($chartStockOut),
            'cat_labels' => json_encode($catLabels),
            'cat_data' => json_encode($catData)
        ];

        return view('dashboard/index', $data);
    }
}

