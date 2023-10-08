<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'department_id' =>  1,
            'name_ar' =>  'مدير عام',
            'name_en' =>  'General manager',
            'active' =>  1,
        ];

        Position::create($data);
    }
}
