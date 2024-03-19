<?php
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\JobPositionController;
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

   

    // Add Applicant
    Route::group(['prefix'=>'applicant'],function(){
        Route::get('/',[ApplicantController::class,'index'])->name('admin.applicant');
        Route::get('/create',[ApplicantController::class,'create'])->name('admin.applicant.create');
        Route::post('/create',[ApplicantController::class,'store'])->name('admin.applicant.store');
        Route::get('edit/{id}',[ApplicantController::class,'edit'])->name('admin.applicant.edit');
        Route::put('edit/{id}',[ApplicantController::class,'update'])->name('admin.applicant.update');
    });

    Route::group(['prefix' =>'passport'],function(){
        Route::get('/',[PassportController::class,'index'])->name('admin.passport');
        Route::get('/create',[PassportController::class,'create'])->name('admin.passport.create');
        Route::post('/create',[PassportController::class,'store'])->name('admin.passport.store');
        Route::get('/edit/{id}',[PassportController::class,'edit'])->name('admin.passport.edit');
        Route::put('/edit/{id}',[PassportController::class,'update'])->name('admin.passport.update');

    });

    // country
    Route::group(['prefix'=>'country'],function(){
        Route::get('/',[CountryController::class,'index'])->name('admin.country');
        Route::get('/create',[CountryController::class,'create'])->name('admin.country.create');
        Route::post('/create',[CountryController::class,'store'])->name('admin.country.store');
        Route::get('edit/{id}',[CountryController::class,'edit'])->name('admin.country.edit');
        Route::put('edit/{id}',[CountryController::class,'update'])->name('admin.country.update');
        Route::get('delete/{id}',[CountryController::class,'delete'])->name('admin.country.delete');
        Route::get('/fetch',[CountryController::class,'fetch'])->name('admin.country.fetch');
    });

    // job position
    Route::group(['prefix'=>'position'],function(){
        Route::get('/',[JobPositionController::class,'index'])->name('admin.position');
        Route::get('/create',[JobPositionController::class,'create'])->name('admin.position.create');
        Route::post('/create',[JobPositionController::class,'store'])->name('admin.position.store');
        Route::get('edit/{id}',[JobPositionController::class,'edit'])->name('admin.position.edit');
        Route::put('edit/{id}',[JobPositionController::class,'update'])->name('admin.position.update');
        Route::get('delete/{id}',[JobPositionController::class,'delete'])->name('admin.position.delete');
       
    });

    // demand
    Route::group(['prefix'=>'demand'],function(){
        Route::get('/',[DemandController::class,'index'])->name('admin.demand');
        Route::get('/create',[DemandController::class,'create'])->name('admin.demand.create');
        Route::post('/create',[DemandController::class,'store'])->name('admin.demand.store');
        Route::get('edit/{id}',[DemandController::class,'edit'])->name('admin.demand.edit');
        Route::put('edit/{id}',[DemandController::class,'update'])->name('admin.demand.update');
        Route::get('delete/{id}',[DemandController::class,'delete'])->name('admin.demand.delete');
    });

    // Users
    Route::group(['prefix'=>'profile'],function(){
        Route::get('/',[ProfileController::class,'index'])->name('admin.profile');
        Route::get('/create',[ProfileController::class,'create'])->name('admin.profile.create');
        Route::post('/create',[ProfileController::class,'store'])->name('admin.profile.store');
        Route::get('edit/{id}',[ProfileController::class,'edit'])->name('admin.profile.edit');
        Route::put('edit/{id}',[ProfileController::class,'update'])->name('admin.profile.update');
        Route::get('delete/{id}',[ProfileController::class,'delete'])->name('admin.profile.delete');
    });
});
