<?php

use App\Helpers\RequestHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/client/{path}', function (Request $request, $path) {
    $client = new Client([
        'base_uri' => config('gateways.customer-services.base_uri'),
        'headers' => RequestHelper::filterHeaders($request->header()),
        'http_errors' => false, // disable guzzle exception on 4xx or 5xx response code
    ]);
    $resp = $client->request($request->method(), $path, [
        'query' => $request->query(),
        'body' => $request->getContent(),
    ]);

    return response($resp->getBody()->getContents(), $resp->getStatusCode())->withHeaders(RequestHelper::filterHeaders($resp->getHeaders()));
})->where('path', '.*');

Route::any('/driver/{path}', function (Request $request, $path) {
    $client = new Client([
        'base_uri' => config('gateways.driver-services.base_uri'),
        'headers' => RequestHelper::filterHeaders($request->header()),
        'http_errors' => false, // disable guzzle exception on 4xx or 5xx response code
    ]);
    $resp = $client->request($request->method(), $path, [
        'query' => $request->query(),
        'body' => $request->getContent(),
    ]);

    return response($resp->getBody()->getContents(), $resp->getStatusCode())->withHeaders(RequestHelper::filterHeaders($resp->getHeaders()));
})->where('path', '.*');

Route::any('/merchant/{path}', function (Request $request, $path) {
    $client = new Client([
        'base_uri' => config('gateways.merchant-services.base_uri'),
        'headers' => RequestHelper::filterHeaders($request->header()),
        'http_errors' => false, // disable guzzle exception on 4xx or 5xx response code
    ]);
    $resp = $client->request($request->method(), $path, [
        'query' => $request->query(),
        'body' => $request->getContent(),
    ]);

    return response($resp->getBody()->getContents(), $resp->getStatusCode())->withHeaders(RequestHelper::filterHeaders($resp->getHeaders()));
})->where('path', '.*');
