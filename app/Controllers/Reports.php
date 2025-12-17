<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use Dompdf\Dompdf;

class Reports extends BaseController
{
    protected $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');

        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        $data['transactions'] = $this->transactionModel->select('transactions.*, products.name as product_name, users.username')
                                                     ->join('products', 'products.id = transactions.product_id')
                                                     ->join('users', 'users.id = transactions.user_id')
                                                     ->where('transactions.created_at >=', $startDate . ' 00:00:00')
                                                     ->where('transactions.created_at <=', $endDate . ' 23:59:59')
                                                     ->orderBy('created_at', 'DESC')
                                                     ->findAll();

        return view('reports/index', $data);
    }

    public function exportPdf()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');

        $transactions = $this->transactionModel->select('transactions.*, products.name as product_name, users.username')
                                             ->join('products', 'products.id = transactions.product_id')
                                             ->join('users', 'users.id = transactions.user_id')
                                             ->where('transactions.created_at >=', $startDate . ' 00:00:00')
                                             ->where('transactions.created_at <=', $endDate . ' 23:59:59')
                                             ->orderBy('created_at', 'ASC')
                                             ->findAll();

        $data = [
            'transactions' => $transactions,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        $html = view('reports/pdf_view', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("ims_report_" . date('Ymd_His') . ".pdf", array("Attachment" => false));
    }
}
