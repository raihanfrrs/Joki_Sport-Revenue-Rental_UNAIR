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
                'email' => 'rehanfarras76@gmail.com',
                'password' => bcrypt('test123'),
                'role' => 'admin'
            ],
            [
                'email' => 'unairsurabaya76@gmail.com',
                'password' => bcrypt('test123'),
                'role' => 'owner'
            ],
            [
                'email' => 'adammaurizio76@gmail.com',
                'password' => bcrypt('test123'),
                'role' => 'renter'
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
