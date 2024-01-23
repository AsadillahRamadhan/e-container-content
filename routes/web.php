<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoadingDockController;
use App\Http\Controllers\OriconController;
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
    // Route::middleware('l/d')->group(function(){
        Route::get('/', [DashboardController::class, 'index']);

        Route::resource('/box', BoxController::class);
        
        Route::get('/pt-56', [Pt56Controller::class, 'index']);
        Route::post('/pt-56', [Pt56Controller::class, 'convert']);
        
        Route::get('/pt-37', [Pt37Controller::class, 'index']);
        Route::post('/pt-37', [Pt37Controller::class, 'convert']);
        
        Route::get('/oricon', [OriconController::class, 'index']);
        Route::post('/oricon', [OriconController::class, 'convert']);

        Route::get('/history', [LoadingDockController::class, 'history']);

    // });

    // Route::middleware('ppc')->group(function(){
    //     Route::get('/', [DashboardController::class, 'index']);
    // });

    // Route::middleware('admin')->group(function(){
    //     Route::get('/', [DashboardController::class, 'index']);
    // });
    
    
    Route::get('/404', function(){
        return view('404');
    });
    
});

Auth::routes();
