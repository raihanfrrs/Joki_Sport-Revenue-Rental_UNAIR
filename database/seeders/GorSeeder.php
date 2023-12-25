<?php

namespace Database\Seeders;

use App\Models\Gor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gors = [
            [
                'owner_id' => 1,
                'name' => 'Gor Futsal ITS',
                'slug' => 'gor-futsal-its',
                'price' => 150000,
                'address' => 'Bund. ITS, Keputih, Kec. Sukolilo, Surabaya, Jawa Timur 60117'
            ],
            // [
            //     'owner_id' => 1,
            //     'name' => 'Lapangan KONI Kertajaya',
            //     'slug' => 'lapangan-koni-surabaya',
            //     'price' => 20000,
            //     'type_duration' => 'in',
            //     'address' => 'Jl. Raya Kertajaya Indah No.4, RT.001/RW.09, Manyar Sabrangan, Kec. Mulyorejo, Surabaya, Jawa Timur 60116'
            // ],
            // [
            //     'owner_id' => 1,
            //     'name' => 'Lapangan Voli Outdoor Kampus C Unair',
            //     'slug' => 'lapangan-voli-outdoor-kampus-c-unair',
            //     'price' => 75000,
            //     'type_duration' => 'hours',
            //     'address' => 'Student Center Kampus C'
            // ]
        ];

        foreach ($gors as $key => $gor) {
            Gor::create($gor);
        }
    }
}
