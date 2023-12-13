<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = [
            [
                'user_id' => 2,
                'nama' => 'Universitas Airlangga Surabaya',
                'alamat' => 'Jl. Dr. Ir. H. Soekarno, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115',
                'ponsel' => '(031) 5914043'
            ]
        ];

        foreach ($owners as $key => $value) {
            Owner::create($value);
        }
    }
}
