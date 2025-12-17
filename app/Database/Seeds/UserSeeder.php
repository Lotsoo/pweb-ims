<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password_hash'    => password_hash('admin123', PASSWORD_DEFAULT),
            'full_name' => 'Administrator',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Simple check to prevent duplicate
        $db = \Config\Database::connect();
        if ($db->table('users')->where('username', 'admin')->countAllResults() == 0) {
           $this->db->table('users')->insert($data);
        }
    }
}
