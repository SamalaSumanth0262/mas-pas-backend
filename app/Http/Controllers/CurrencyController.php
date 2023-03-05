<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index()
    {
        // Can be implemented with memcache or redis caching
        $end_point = "https://api.apilayer.com/exchangerates_data/latest";
        $cached_response = Cache::store('file')->get('response');
        if (isset($cached_response)) {
            return $cached_response;
        }
        $response = Http::accept('application/json')->withHeaders(['apikey' => 'Nx26GuQ2puzwWGVSygLYMsG3FnrrqVjB'])->get($end_point, [
            'symbols' => "USD, EUR, CHF, AUD, CAD",
            'base' => 'GBP'
        ]);
        $result = $response->json();
        // 120 two minutes caching
        Cache::store('file')->put('response', $result, 120);
        return $result;
    }
}
