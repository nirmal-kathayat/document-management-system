<?php
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadershipBoardController;
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'admin',], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Add Applicant
    Route::group(['prefix'=>'applicants'],function(){
        Route::get('/',[ApplicantController::class,'index'])->name('admin.applicant');
        Route::get('/create',[ApplicantController::class,'create'])->name('admin.applicant.create');
        Route::post('/create',[ApplicantController::class,'store'])->name('admin.applicant.store');
        Route::get('edit/{id}',[ApplicantController::class,'edit'])->name('admin.applicant.edit');
        Route::put('edit/{id}',[ApplicantController::class,'update'])->name('admin.applicant.update');
        Route::get('delete/{id}',[ApplicantController::class,'delete'])->name('admin.applicant.delete');
        Route::post('export',[ApplicantController::class,'export'])->name('admin.applicant.export');
        Route::get('/move',[ApplicantController::class,'move'])->name("admin.applicant.move");
        Route::get('/info/{id}',[ApplicantController::class,'info'])->name("admin.applicant.info");
    });

    Route::group(['prefix' =>'passports'],function(){
        Route::get('/',[PassportController::class,'index'])->name('admin.passport');
        Route::get('/create',[PassportController::class,'create'])->name('admin.passport.create');
        Route::post('/create',[PassportController::class,'store'])->name('admin.passport.store');
        Route::get('/edit/{id}',[PassportController::class,'edit'])->name('admin.passport.edit');
        Route::put('/edit/{id}',[PassportController::class,'update'])->name('admin.passport.update');

    });

    // country
    Route::group(['prefix'=>'countries'],function(){
        Route::get('/',[CountryController::class,'index'])->name('admin.country');
        Route::get('/create',[CountryController::class,'create'])->name('admin.country.create');
        Route::post('/create',[CountryController::class,'store'])->name('admin.country.store');
        Route::get('edit/{id}',[CountryController::class,'edit'])->name('admin.country.edit');
        Route::put('edit/{id}',[CountryController::class,'update'])->name('admin.country.update');
        Route::get('delete/{id}',[CountryController::class,'delete'])->name('admin.country.delete');
        Route::get('/fetch',[CountryController::class,'fetch'])->name('admin.country.fetch');
    });

    // job position
    Route::group(['prefix'=>'positions'],function(){
        Route::get('/',[JobPositionController::class,'index'])->name('admin.position');
        Route::get('/create',[JobPositionController::class,'create'])->name('admin.position.create');
        Route::post('/create',[JobPositionController::class,'store'])->name('admin.position.store');
        Route::get('edit/{id}',[JobPositionController::class,'edit'])->name('admin.position.edit');
        Route::put('edit/{id}',[JobPositionController::class,'update'])->name('admin.position.update');
        Route::get('delete/{id}',[JobPositionController::class,'delete'])->name('admin.position.delete');
       
    });

    Route::group(['prefix'=>'demands'],function(){
        Route::get('/',[DemandController::class,'index'])->name('admin.demand');
        Route::get('/create',[DemandController::class,'create'])->name('admin.demand.create');
        Route::post('/create',[DemandController::class,'store'])->name('admin.demand.store');
        Route::get('edit/{id}',[DemandController::class,'edit'])->name('admin.demand.edit');
        Route::put('edit/{id}',[DemandController::class,'update'])->name('admin.demand.update');
        Route::get('delete/{id}',[DemandController::class,'delete'])->name('admin.demand.delete');
        Route::post('export',[DemandController::class,'export'])->name('admin.demand.export');
        
    });

    Route::group(['prefix' => 'leadershipBoard'],function(){
        Route::get('/',[LeadershipBoardController::class,'index'])->name('admin.leadershipBoard');
    });

    Route::group(['prefix' =>'profile'],function(){
        Route::get('/',[ProfileController::class,'index'])->name('admin.profile');
        Route::put('edit',[ProfileController::class,'update'])->name('admin.profile.update');
    });
    

    Route::group(['prefix'=>'changePassword'],function(){
        Route::get('/',[ChangePasswordController::class,'index'])->name('admin.changePassword.create');
        Route::post('/edit',[ChangePasswordController::class,'passwordChange'])->name('admin.changePassword.passwordChange');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission');
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.permission.create');
        Route::post('/create', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::post('edit/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
        Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    });

      Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/create', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('edit/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::get('delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    });
    Route::group(['prefix'=>'users'],function(){
        Route::get('/',[UserController::class,'index'])->name('admin.user');
        Route::get('/create',[UserController::class,'create'])->name('admin.user.create');
        Route::post('/create',[UserController::class,'store'])->name('admin.user.store');
        Route::get('edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
        Route::put('edit/{id}',[UserController::class,'update'])->name('admin.user.update');
        Route::get('delete/{id}',[UserController::class,'delete'])->name('admin.user.delete');
    });





});
