<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// simple helper function to filter header array on request & response
function filterHeaders($headers)
{
    $allowedHeaders = ['accept', 'content-type', 'authorization'];
    return array_filter($headers, function ($key) use ($allowedHeaders) {
        return in_array(strtolower($key), $allowedHeaders);
    }, ARRAY_FILTER_USE_KEY);
}

Route::get('/', function () {
    return response()->json('Welcome to Gateway Service');
});

Route::any('/api/{path}', function (Request $request, $path) {
    $client = new Client([
        'base_uri' => config('gateways.customer-services.base_uri'),
        'headers' => filterHeaders($request->header()),
        'http_errors' => false, // disable guzzle exception on 4xx or 5xx response code
    ]);
    $resp = $client->request($request->method(), $path, [
        'query' => $request->query(),
        'body' => $request->getContent(),
    ]);

    return response($resp->getBody()->getContents(), $resp->getStatusCode())->withHeaders(filterHeaders($resp->getHeaders()));
})->where('path', '.*');

Route::any('/driver-api/{path}', function (Request $request, $path) {
    $client = new Client([
        'base_uri' => config('gateways.driver-services.base_uri'),
        'headers' => filterHeaders($request->header()),
        'http_errors' => false, // disable guzzle exception on 4xx or 5xx response code
    ]);
    $resp = $client->request($request->method(), $path, [
        'query' => $request->query(),
        'body' => $request->getContent(),
    ]);

    return response($resp->getBody()->getContents(), $resp->getStatusCode())->withHeaders(filterHeaders($resp->getHeaders()));
})->where('path', '.*');

Route::any('/merchant-api/{path}', function (Request $request, $path) {
    $client = new Client([
        'base_uri' => config('gateways.merchant-services.base_uri'),
        'headers' => filterHeaders($request->header()),
        'http_errors' => false, // disable guzzle exception on 4xx or 5xx response code
    ]);
    $resp = $client->request($request->method(), $path, [
        'query' => $request->query(),
        'body' => $request->getContent(),
    ]);

    return response($resp->getBody()->getContents(), $resp->getStatusCode())->withHeaders(filterHeaders($resp->getHeaders()));
})->where('path', '.*');
