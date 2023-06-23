<?php

namespace App\Database\Seeds;

use App\Models\DatauserModel;
use CodeIgniter\Database\Seeder;

class DatauserSeeder extends Seeder
{
    public function run()
    {
        $id = (new DatauserModel())->insert([
            'nama'              => 'kolas',
            'username'          => 'kolas',
            'password'          => password_hash('123456', PASSWORD_BCRYPT), 
            'level'             => 'Pengguna',  
            'alamat'            => 'deskap', 
        ]);
            echo "hasil id = $id";

    }
}
