<?php

namespace Database\Seeders;

use App\Models\Renter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $renters = [
            [
                'user_id' => 3,
                'name' => 'Adam Maurizio',
                'phone' => '081727383923'
            ]
        ];

        foreach ($renters as $key => $value) {
            Renter::create($value);
        }
    }
}
