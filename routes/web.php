<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('welcome');
})->name('home');
// <--==================================================Login/Signup Routes=================================================================================================-->
Route::get('vendor-Login/signup',[LoginController::class,'vendor_login_signup'])->name('vendor_login_signup');
Route::post('user-signup',[LoginController::class,'sign_up'])->name('user_signup');
Route::post('user-login',[LoginController::class,'login'])->name('user_login');
Route::get('user-logout',[LoginController::class,'logout'])->name('logout');
Route::post('vendor-signup',[LoginController::class,'vendor_sign_up'])->name('vendor_signup');
Route::post('vendor-login',[LoginController::class,'vendor_login'])->name('vendor_login');
// <--==================================================Login/Signup Routes=================================================================================================-->

// <--==================================================User Routes=========================================================================================================-->
Route::get('user-dashboard', [UserController::class,'index'])->name('user_dashboard');
// <--==================================================User Routes=========================================================================================================-->

// <--==================================================Vendor's Routes======================================================================================================-->
Route::get('vendor-dashboard', [VendorController::class,'index'])->name('vendor_dashboard');
// <--==================================================Vendor's Routes======================================================================================================-->

// <--==================================================Admin's Routes=======================================================================================================-->
Route::get('admin-dashboard', [AdminController::class,'index'])->name('admin_dashboard');
// <--==================================================Admin's Routes=======================================================================================================-->

