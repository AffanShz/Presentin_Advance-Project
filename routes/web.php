<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterTutorialController;
use App\Http\Controllers\DetailTutorialController;
use App\Http\Controllers\PublicTutorialController;

Route::view('/login','login')->name('login');

Route::post('/login-action', [AuthController::class, 'Login']);

Route::middleware([\App\Http\Middleware\CheckAuthToken::class])->group(function(){
    
    Route::get('/master-tutorial', function(){
        return view('master_tutorial');
    });

    Route::get('/logout-action', [AuthController::class, 'logout']);

    Route::get('/master-tutorial', [MasterTutorialController::class, 'index']);
    Route::get('/master-tutorial/create', [MasterTutorialController::class, 'create']);
    Route::post('/master-tutorial', [MasterTutorialController::class, 'store']);

    Route::post('/detail-tutorial', [DetailTutorialController::class, 'store']);

    Route::get('/tutorial/{slug}', [PublicTutorialController::class, 'presentation']);
    
    Route::get('/finished/{slug}', [PublicTutorialController::class, 'finished']);
});
