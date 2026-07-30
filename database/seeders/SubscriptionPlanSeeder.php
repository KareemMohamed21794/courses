<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run()
    {
        $defaults = [
            ['name' => 'Quarterly (3 Months)', 'duration_in_months' => 3, 'price' => 30],
            ['name' => 'Semi-Annual (6 Months)', 'duration_in_months' => 6, 'price' => 50],
            ['name' => 'Annual (12 Months)', 'duration_in_months' => 12, 'price' => 90],
        ];

        foreach ($defaults as $plan) {
            SubscriptionPlan::firstOrCreate(
                [
                    'course_id' => null,
                    'duration_in_months' => $plan['duration_in_months'],
                ],
                [
                    'name' => $plan['name'],
                    'price' => $plan['price'],
                    'is_active' => true,
                ]
            );
        }
    }
}
