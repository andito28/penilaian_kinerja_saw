<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LaskarPelangiController;

Auth::routes();

Route::get('/', function () {
    return view("auth.login");
});

Route::group(['middleware' => ['auth','checkRole:admin']],function(){
    //dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');

    //laskar pelangi
    Route::get('/laskar-pelangi', [LaskarPelangiController::class, 'index'])->name('laskar.index');
    Route::get('/laskar-pelangi/create', [LaskarPelangiController::class, 'create'])->name('laskar.create');
    Route::get('/laskar-pelangi/edit/{id}', [LaskarPelangiController::class, 'edit'])->name('laskar.edit');
    Route::post('/laskar-pelangi/store', [LaskarPelangiController::class, 'store'])->name('laskar.store');
    Route::put('/laskar-pelangi/update/{id}', [LaskarPelangiController::class, 'update'])->name('laskar.update');
    Route::delete('/laskar-pelangi/delete', [LaskarPelangiController::class, 'destroy'])->name('laskar.delete');

    //kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::get('/kriteria/edit/{id}', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::post('/kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/kriteria/update/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/delete', [KriteriaController::class, 'destroy'])->name('kriteria.delete');
});

