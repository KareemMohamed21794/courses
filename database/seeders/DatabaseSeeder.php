<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WareHouseLocation;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithFaker;

    public function __construct()
    {
        $this->setUpFaker();
    }


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        


        if(app()->environment('local')){
             

            // $supplier = Client::create([
            //     'email' => 'supplier1@gmail.com',
            //     'name_ar' => 'sup_ar',
            //     'name_en' => 'sup_en',
            //     'code' => uniqid(),
            //     'phone' => $this->faker->phoneNumber(),
            //     'fax' => uniqid(),
            //     'start_date' => now()->toDateString(),
            //     'country' => 'Egypt',
            //     'governorate' => 'Cairo',
            //     'city' => 'Nasr City',
            //     'password' => bcrypt('password'),
            //     'active' => true,
            //     'client_customer_type' => Client::TYPE_SUPPLIER
            // ]);

            // $product = Product::create([
            //     'client_id' => $supplier->id,
            //     'name_ar' => 'prod_ar',
            //     'name_en' => 'prod_en',
            //     'code' => uniqid(),
            //     'price' => 20,
            //     'unit' => 'box',
            //     'quantity' => 100,
            //     'active' => true,
            //     'manufacture_id' => null
            // ]);

        }

//        $this->call(BranchesTableSeeder::class);
//        $this->call(DepartmentsTableSeeder::class);

//        $path = __DIR__ . "/qalam_seed.sql";
//        DB::unprepared(file_get_contents($path));

    }
}
