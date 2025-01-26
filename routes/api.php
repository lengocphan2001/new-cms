<?php

use App\Http\Controllers\Api\StageProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/product-stages/{productId}', [StageProductController::class, 'getStagesByProduct'])->name('product_stages');

Route::get('/user-stages/{productId}/{userId}', [StageProductController::class, 'getStageByProductAndUserId'])->name('user_stages');
