<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'user_id' => 1,
                'name' => 'Admin 001',
                'slug' => 'admin-001',
                'phone' => '081333903187'
            ]
        ];

        foreach ($admins as $key => $value) {
            Admin::create($value);
        }
    }
}
