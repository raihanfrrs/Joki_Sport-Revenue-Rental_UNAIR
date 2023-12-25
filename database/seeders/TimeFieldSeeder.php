<?php

namespace Database\Seeders;

use App\Models\TimeField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time_fields = [
            [
                'start' => '06:00',
                'end' => '07:00'
            ],
            [
                'start' => '07:00',
                'end' => '08:00'
            ],
            [
                'start' => '08:00',
                'end' => '09:00'
            ],
            [
                'start' => '09:00',
                'end' => '10:00'
            ],
            [
                'start' => '10:00',
                'end' => '11:00'
            ],
            [
                'start' => '11:00',
                'end' => '12:00'
            ],
            [
                'start' => '12:00',
                'end' => '13:00'
            ],
            [
                'start' => '13:00',
                'end' => '14:00'
            ],
            [
                'start' => '14:00',
                'end' => '15:00'
            ],
            [
                'start' => '15:00',
                'end' => '16:00'
            ],
            [
                'start' => '16:00',
                'end' => '17:00'
            ],
            [
                'start' => '18:00',
                'end' => '19:00'
            ],
            [
                'start' => '19:00',
                'end' => '20:00'
            ],
            [
                'start' => '20:00',
                'end' => '21:00'
            ],
            [
                'start' => '21:00',
                'end' => '22:00'
            ],
            [
                'start' => '22:00',
                'end' => '23:00'
            ],
            [
                'start' => '23:00',
                'end' => '00:00'
            ],
        ];

        foreach ($time_fields as $key => $time_field) {
            TimeField::create($time_field);
        }
    }
}
