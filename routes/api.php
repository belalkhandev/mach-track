<?php

use App\Http\Controllers\Api\AuthController;
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

Route::get('/', function() {
    return response()->json([
        'service' => 'API',
        "status" => "Ok",
        "version" => "1.0.0",
        "message" => "Hello! I am machine tracker",
    ]);
});

Route::group([
    'prefix' => 'user',
], function ($route) {
    $route->post('login', [AuthController::class, 'login']);
});
