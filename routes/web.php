<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'admin',], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission');
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.permission.create');
        Route::post('/create', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::post('edit/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
        Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    });

    // profile
    Route::group(['prefix'=>'profile'],function(){
        Route::get('/create',[ProfileController::class,'create'])->name('admin.profile.create');
    });
});
