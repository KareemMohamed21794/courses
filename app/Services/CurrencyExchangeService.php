<?php

namespace App\Services;
use App\Models\CurrencyExchange;


class CurrencyExchangeService
{
    const CURRENCY_DEFAULT = [
        'Credit' => 'EGP',
        'Debit' => 'EGP'
    ];

    const SUPPORTED_CURRENCIES = ['EGP', 'USD'];


    public static function getBalance($debitAmount, $creditAmount, $debitCurrency)
    {
        if(in_array($debitCurrency, CurrencyExchangeService::SUPPORTED_CURRENCIES) && $debitCurrency !== 'EGP'){
            $currencyExchange = CurrencyExchange::getCurrency($debitCurrency);
            $debitAmount = $debitAmount * $currencyExchange->ratio;
        }

        return $debitAmount - $creditAmount;
    }
    

}
