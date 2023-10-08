<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Client;
use App\Models\ClientBalanceSheet;
use App\Models\CurrencyExchange;
use App\Services\CurrencyExchangeService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientBalanceTestCases extends TestCase
{
    use DatabaseTransactions;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::find(1);
        $this->actingAs($this->admin, 'admin');
        $this->withoutExceptionHandling();
        $this->handleValidationExceptions();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_supplier_can_add_balance()
    {
        $supplier = Client::where('client_customer_type', '=', 'supplier')
        ->first();

        $creditAmount =  700;
        $debitAmount =  300;
        $debitCurrency = 'EGP';
        $notes = 'test user can credit';

        $balance = CurrencyExchangeService::getBalance($debitAmount, $creditAmount, $debitCurrency);

        $response = $this->post(route('balance-sheet.store'), [
            'debit_amount' => $debitAmount,
            'credit_amount' => $creditAmount,
            'debit_currency' => $debitCurrency,
            'notes' => $notes,
            'client_id' => $supplier->id,
        ]);

        $response->assertStatus(200);

        // dd(ClientBalanceSheet::latest()->first()->toArray());

        $this->assertDatabaseHas('client_balance_sheets', [
            'client_id' => $supplier->id,
            'debit_amount' => $debitAmount,
            'credit_amount' => $creditAmount,
            'debit_currency_id' => 1,
            'notes' => $notes,
            'balance_amount' => $balance
        ]);
    }


    public function test_admin_can_show_supplier_balance()
    {
        $supplier = Client::where('client_customer_type', '=', 'supplier')->first();

        $creditAmount =  0;
        $debitAmount =  700;
        $notes = 'Test Balance';

        ClientBalanceSheet::factory()->count(2)->create([
            'admin_id' => 1,
            'client_id' => $supplier->id,
            'debit_currency_id' => 1,
            'credit_currency_id' => 1,
            'debit_amount' => $debitAmount,
            'credit_amount' => $creditAmount,
            'notes' => $notes,
            'balance_amount' => CurrencyExchangeService::getBalance($debitAmount, $creditAmount, 'EGP')
        ]);


        $response = $this->get(route('balance-sheet.show', ['client' => $supplier->id]));

        $response->assertStatus(200);

        $resBalance = $response->json();
        $this->assertEquals($resBalance['balance'], $debitAmount* 2);
    }
}
