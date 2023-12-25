<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'gor_id' => 1,
                'field_category_id' => 1,
                'name' => 'Lapangan Futsal Dewasa',
                'slug' => 'lapangan-futsal-dewasa',
                'description' => 'Lorem Ipsum'
            ]
        ];

        foreach ($fields as $key => $field) {
            Field::create($field);
        }
    }
}
