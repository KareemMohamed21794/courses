<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\BasePermission;
use App\Models\Permission;
use App\Models\Position;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BasePermissionsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;
    use WithFaker;


    public function test_admin_can_not_view()
    {
//        $this->withoutExceptionHandling();
        $routeNames = [
            'admins.index',
            'allowances.index',
//            'assign-permissions.index',
            'balance-sheet.index',
            'branches.index',
            'categories.index',
            'clients.index',
            'departments.index',
            'expenses.index',
            'expenses_items.index',
            'incomes.index',
            'incomes_items.index',
            'late_deductions.index',
            'missions_types.index',
            'official_vacations.index',
            'official_vacations_days.index',
            'pay_salaries.index',
            'permissions.index',
            'positions.index',
            'products.index',
            'punishment_rules.index',
            'roles.index',
            'shifts.index',
//            'staff.index',
            'staff_activites.index',
            'staff_allowances.index',
            'staff_debts.index',
            'staff_loans.index',
            'staff_missions.index',
            'staff_punishments.index',
            'staff_requests.index',
            'staff_rewards.index',
            'staff_salaries.index',
            'staff_shifts.index',
            'staff_vacations.index',
            'suppliers.index',
            'vacations_types.index',
            'warehouse-locations.index',
            'warehouse-transfer.index',
            'warehouse_reports.index',
        ];

        $data = [
            'name' =>  'Webmaster',
            'email' =>  'admin-test@qalam.com',
            'password' => bcrypt('password'),
            'is_super' => 1,
        ];

        $admin = Admin::create($data);
        $this->actingAs($admin, 'admin');
        $this->assertAuthenticated('admin');

        foreach ($routeNames as $routeName) {
            dump(route($routeName));
            $res = $this->get(route($routeName));
            $res->assertStatus(403);
        }

        $routeNames2 = [
            url('admin/reports/account_statement'),
            url('admin/reports/average_product_report'),
            url('admin/reports/client_withdrawal_report'),
            url('admin/reports/get'),
            url('admin/reports/product_movement_reports'),
            url('admin/reports/product_movement_reports_get'),
            url('admin/reports/product_withdrawal_report'),
            url('admin/reports/sales_report'),
        ];

        foreach ($routeNames2 as $routeName) {
            dump($routeName);
            $res = $this->get($routeName);
            $res->assertStatus(403);
        }

    }

    public function test_admin_can_view()
    {
//        $this->withoutExceptionHandling();
        $routeNames = [
            'admins.index',
            'allowances.index',
//            'assign-permissions.index',
            'balance-sheet.index',
            'branches.index',
            'categories.index',
            'clients.index',
            'departments.index',
            'expenses.index',
            'expenses_items.index',
            'incomes.index',
            'incomes_items.index',
            'late_deductions.index',
            'missions_types.index',
            'official_vacations.index',
            'official_vacations_days.index',
            'pay_salaries.index',
            'permissions.index',
            'positions.index',
            'products.index',
            'punishment_rules.index',
            'roles.index',
            'shifts.index',
//            'staff.index',
            'staff_activites.index',
            'staff_allowances.index',
            'staff_debts.index',
            'staff_loans.index',
            'staff_missions.index',
            'staff_punishments.index',
            'staff_requests.index',
            'staff_rewards.index',
            'staff_salaries.index',
            'staff_shifts.index',
            'staff_vacations.index',
            'suppliers.index',
            'vacations_types.index',
            'warehouse-locations.index',
            'warehouse-transfer.index',
            'warehouse_reports.index',
        ];

        $data = [
            'name' =>  'Webmaster',
            'email' =>  'admin-test@qalam.com',
            'password' => bcrypt('password'),
            'is_super' => 1,
        ];

        $admin = Admin::create($data);
        $this->actingAs($admin, 'admin');
        $this->assertAuthenticated('admin');

        $models = BasePermission::MODELS;
        $position = Position::create([
            'department_id' => 1,
            'name_ar' => 'p_test_ar',
            //'name_en' => 'p_test_en',
            'description_ar' => 'p_test_ar',
            'description_en' => 'p_test_ar',
            'active' => 1,
        ]);

        foreach ($models as $model) {
            $objPermission = new Permission();
            $objPermission->position_id = $position->id;
            $objPermission->permission_name = $model.'-viewAny';
            $objPermission->save();
        }

        $admin->position_id = $position->id;
        $admin->save();

        dump(DB::table('permissions')->get()->toArray());
        dump($admin->load('position.permissions')->toArray());

        foreach ($routeNames as $routeName) {
            dump(route($routeName));
            $res = $this->get(route($routeName));
            $res->assertStatus(200);
        }

        $routeNames2 = [
            url('admin/reports/account_statement'),
            url('admin/reports/average_product_report'),
            url('admin/reports/client_withdrawal_report'),
//            url('admin/reports/get'),
            url('admin/reports/product_movement_reports'),
//            url('admin/reports/product_movement_reports_get'),
            url('admin/reports/product_withdrawal_report'),
            url('admin/reports/sales_report'),
        ];

        foreach ($routeNames2 as $routeName) {
            dump($routeName);
            $res = $this->get($routeName);
            $res->assertStatus(200);
        }

    }
}
