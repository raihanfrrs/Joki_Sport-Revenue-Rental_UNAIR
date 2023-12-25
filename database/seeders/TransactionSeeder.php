<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'renter_id' => 1,
                'gor_id' => 1,
                'grand_total' => 150000
            ]
        ];

        foreach ($transactions as $key => $transaction) {
            Transaction::create($transaction);
        }
    }
}
