<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view("auth.login");
});

Route::group(['middleware' => ['auth','checkRole:admin']],function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard_index');

    //laskar pelangi
    Route::get('/laskar-pelangi', [LaskarPelangiController::class, 'index'])->name('laskar.index');
});

