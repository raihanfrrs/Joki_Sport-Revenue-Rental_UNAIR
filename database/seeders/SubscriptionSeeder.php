<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptions = [
            [
                'name' => 'Gratis',
                'slug' => 'gratis',
                'slogan' => 'Permulaan awal untuk anda',
                'price' => 0,
                'image' => 'assets/img/illustrations/page-pricing-basic.png',
                'description' => '
                    <ul class="ps-3 my-4 pt-2">
                        <li class="mb-2">Hanya dapat tambah 1 lapangan</li>
                        <li class="mb-2">Hanya dapat tambah 1 gor</li>
                        <li class="mb-2">Tidak priotitas layanan</li>
                        <li class="mb-2">Peningkatan standar</li>
                    </ul>
                '
            ],
            [
                'name' => 'Superior',
                'slug' => 'superior',
                'slogan' => 'Solusi mengatur banyak kebutuhan',
                'price' => 2000000,
                'image' => 'assets/img/illustrations/page-pricing-enterprise.png',
                'description' => '
                    <ul class="ps-3 my-4 pt-2">
                        <li class="mb-2">Bebas tambah banyak lapangan</li>
                        <li class="mb-2">Bebas tambah banyak gor</li>
                        <li class="mb-2">Prioritas pelayanan</li>
                        <li class="mb-2">Peningkatan pesanan</li>
                    </ul>
                '
            ]
        ];

        foreach ($subscriptions as $key => $value) {
            Subscription::create($value);
        }
    }
}
