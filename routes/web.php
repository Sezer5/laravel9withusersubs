<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminHomeController as AdminHomeController;
use App\Http\Controllers\admin\UserAuthController as UserAuthController;
use App\Http\Controllers\admin\AdminRoleController as AdminRoleController;
use App\Http\Controllers\admin\AdminProfileController as AdminProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('login','admin.login')->name('login');
Route::post('/user' , [UserAuthController::class,'login'])->name('user');
Route::middleware('auth')->group(function () {

    Route::get('/userroles' ,[AdminRoleController::class,'index'])->name('userroles');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/' , [AdminHomeController::class,'index'])->name('index');


    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::post('/usercreateadd' , [UserAuthController::class,'usercreateadd'])->name('usercreateadd');
        Route::view('usercreate','admin.usercreate')->name('usercreate');
        Route::get('/logoutuser' ,[UserAuthController::class,'logout'])->name('logoutuser');


    });

    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/userroles' , [AdminRoleController::class,'index'])->name('userroles');
        Route::get('/destroyrole/{uid}/{rid}' , [AdminRoleController::class,'destroyrole'])->name('destroyrole');
        Route::post('/addrole' , [AdminRoleController::class,'addrole'])->name('addrole');

    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/' , [AdminProfileController::class,'index'])->name('index');
        Route::post('/update' , [AdminProfileController::class,'update'])->name('update');


    });

});
