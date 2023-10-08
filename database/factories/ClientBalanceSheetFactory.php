<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientBalanceSheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => 1,
            'invoice_id' => null,
            'debit_currency_id' => 1,
            'credit_currency_id' => 1,
            'debit_amount' => rand(0, 2000), // Added
            'credit_amount' => rand(), // Subtracted
            'balance_amount' => rand(),
            'notes' => $this->faker->paragraph
        ];
    }
}
