<?php

namespace Database\Seeders;

use App\Models\DetailTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail_transactions = [
            [
                'transaction_id' => 1,
                'field_id' => 1,
                'detail_field_id' => 1,
                'day_name' => 'selasa',
                'date' => now()->format('Y-m-d'),
                'subtotal' => 75000
            ]
        ];

        foreach ($detail_transactions as $key => $detail_transaction) {
            DetailTransaction::create($detail_transaction);
        }
    }
}
