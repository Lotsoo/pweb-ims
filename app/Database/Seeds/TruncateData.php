<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TruncateData extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();
        
        // Truncate in order (optional due to disabled checks, but good practice)
        $this->db->table('transactions')->truncate();
        $this->db->table('products')->truncate();
        $this->db->table('categories')->truncate();
        
        $this->db->enableForeignKeyChecks();
        
        echo "Tables truncated successfully.\n";
    }
}
