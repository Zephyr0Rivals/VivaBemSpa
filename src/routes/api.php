<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\StatusController;
// use App\Http\Controllers\Api\V1\

Route::prefix('v1')->group(function (){

    // STATUS DA API
    Route::get('/status', [StatusController::class, 'index']);

    //


});