<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoadingDockController;
use App\Http\Controllers\OriconController;
use App\Http\Controllers\PPCController;
use App\Http\Controllers\Pt37Controller;
use App\Http\Controllers\Pt56Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->middleware('isAuth')->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::middleware('l/d')->group(function(){

        Route::resource('/box', BoxController::class); 
        Route::resource('/pt-56', Pt56Controller::class);     
        Route::resource('/pt-37', Pt37Controller::class);
        Route::resource('/oricon', OriconController::class);
        Route::get('/loadingdock/create', [LoadingDockController::class, 'create']);
        Route::post('/loadingdock', [LoadingDockController::class, 'store']);
        
        Route::get('/history', [LoadingDockController::class, 'history']);
        
        Route::post('/update-checkbox-1/{id}', [LoadingDockController::class, 'updateCheckbox']);
        Route::get('/loadingdock/{id}/edit', [LoadingDockController::class, 'edit']);
        Route::put('/loadingdock/{id}', [LoadingDockController::class, 'update']);
        Route::delete('/loadingdock/{id}', [LoadingDockController::class, 'destroy']);
    })->name('l/d');

    Route::middleware('ppc')->group(function(){
        Route::get('/request-ppc', [PPCController::class, 'request']);
        Route::post('/update-checkbox-2/{id}', [PPCController::class, 'update']);
        Route::get('/history-ppc', [PPCController::class, 'history']);
        
    });

    Route::middleware('admin')->group(function(){
        Route::get('/request-admin', [AdminController::class, 'request']);
        Route::post('/update-container-number/{id}', [AdminController::class, 'update']);
        Route::get('/history-admin', [AdminController::class, 'history']);
    })->name('admin');
    
    
    Route::get('/404', function(){
        return view('404');
    });
    
});

Auth::routes();
