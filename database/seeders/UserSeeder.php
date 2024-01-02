<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'admin001@gmail.com',
                'password' => bcrypt('test123'),
                'role' => 'admin'
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
