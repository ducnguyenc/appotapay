<?php

use App\Http\Controllers\Api\V1\TransferController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('/service/transfer')->group(function () {
        Route::post('/make', [TransferController::class, 'make']);
    });
});
