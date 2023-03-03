<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index()
    {
        $response = Http::accept('application/json')->withHeaders(['apikey' => env('CURRENCY_API_KEY')])->get('https://api.apilayer.com/exchangerates_data/latest', [
            'symbols' => "USD, EUR, CHF, AUD, CAD",
            'base' => 'GBP'
        ]);
        return $response->json();
    }
}
