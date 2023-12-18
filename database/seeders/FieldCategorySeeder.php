<?php

namespace Database\Seeders;

use App\Models\FieldCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $field_categories = [
            [
                'owner_id' => 1,
                'name' => 'futsal',
                'slug' => 'futsal'
            ],
            [
                'owner_id' => 1,
                'name' => 'voli',
                'slug' => 'voli'
            ],
            [
                'owner_id' => 1,
                'name' => 'badminton',
                'slug' => 'badminton'
            ]
        ];

        foreach ($field_categories as $key => $field_category) {
            FieldCategory::create($field_category);
        }
    }
}
