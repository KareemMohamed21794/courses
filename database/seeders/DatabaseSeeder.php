<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
    }
}
