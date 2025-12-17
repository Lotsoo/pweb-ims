<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['product_id', 'user_id', 'type', 'quantity', 'notes'];
    protected $useTimestamps    = true;
    protected $updatedField     = ''; // Transactions usually don't have an updated_at field for history integrity
}
