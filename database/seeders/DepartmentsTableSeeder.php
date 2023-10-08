<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name_ar' =>  'إدارة',
            'name_en' =>  'administration',
            'active' =>  1,
        ];

        Department::create($data);


        $data = [
            'name_ar' =>  'lawer',
            'name_en' =>  'اداره المحاماه',
            'active' =>  1,
        ];

        Department::create($data);

        $data = [
            'name_ar' =>  'lawer',
            'name_en' =>  'اداره  السكرتاريه',
            'active' =>  1,
        ];

        Department::create($data);
    }
}
