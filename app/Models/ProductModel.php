<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['category_id', 'name', 'sku', 'stock_quantity', 'price', 'image'];
    protected $useTimestamps    = true;
}
