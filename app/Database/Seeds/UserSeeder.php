<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 'b3c1c9e0-9f9a-4e5a-8d0a-5c0d9e1a2b3a',
                'username' => 'admin',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'email'    => 'admin@lapan-tech.com',
            ],
        ];

        $model = new UserModel();

        foreach ($data as $user) {
            $model->insert($user);
        }
    }
}
