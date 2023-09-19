<?php

namespace App\Http\Controllers\Api\Implement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getCountriesApiData()
    {
        $apiUrl = 'https://restcountries.com/v3.1/name/bangladesh';

        $response = Http::get($apiUrl);

        $data = $response->json();

        echo $data[0]['name']['nativeName']['ben']['official'];
    }
}
