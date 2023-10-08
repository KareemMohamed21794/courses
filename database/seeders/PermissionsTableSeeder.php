<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Admin-viewAny',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Admin-store',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Admin-update',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Admin-delete',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Permission-store',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Permission-viewAny',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Permission-update',
        ];

        Permission::create($data);

        $data = [
            'position_id' =>  1,
            'permission_name' =>  'Permission-delete',
        ];

        Permission::create($data);
    }
}
