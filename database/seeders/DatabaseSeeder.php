<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            OwnerSeeder::class,
            RenterSeeder::class,
            GorSeeder::class,
            // FieldSeeder::class,
            FieldCategorySeeder::class,
            TimeFieldSeeder::class,
            TransactionSeeder::class,
            DetailTransactionSeeder::class
        ]);
    }
}
