<?php

namespace Database\Seeders;

use App\Models\OwnerSubscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner_subscriptions = [
            [
                'subscription_id' => 1,
                'owner_id' => 1,
            ]
        ];

        foreach ($owner_subscriptions as $key => $value) {
            OwnerSubscription::create($value);
        }
    }
}
