<?php

use App\Http\Controllers\Entries\GetEntryController;
use App\Http\Controllers\Entries\GetAnEntryController;
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

Route::group([], function () {
    Route::group(['prefix' => '/entries'], function () {
        Route::get('/', GetEntryController::class);
        Route::get('/{entryId}', GetAnEntryController::class)->where(['entryId' => '[0-9]+']);
    });

});