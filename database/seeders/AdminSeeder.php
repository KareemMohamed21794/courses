<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' =>  'Webmaster',
            'position_id' =>  1,
            'username' =>  'admin',
            'email' =>  'admin@tawasol.com',
            'password' => bcrypt('IUK@24D2xtH6'),
            'is_super' => 1,
        ];

        Admin::create($data);
    }
}
