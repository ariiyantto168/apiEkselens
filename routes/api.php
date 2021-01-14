<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogActivitiesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClassController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['jwt.verify']], function () {
        
        Route::post('logout', [AuthController::class, 'logout']);
        //profile
        Route::get('profile', [AuthController::class, 'profile']);
        //log activity
        Route::get('log-activity', [LogActivitiesController::class, 'index']);
    
        //transaction
        Route::post('transaction', [TransactionsController::class, 'create_save']);
        Route::get('transaction/mutasi', [TransactionsController::class, 'get_mutasi']);

        Route::post('orders', [OrderController::class, 'save_order']);
        Route::get('orders/status/{order}', [OrderController::class, 'status_payment']);
        // notifications
        

          // class
        Route::get('class', [ClassController::class, 'index_auth']);
        Route::get('class/{classes}', [ClassController::class, 'select_id_auth']);
        Route::get('class/detail/{classes}', [ClassController::class, 'classdetail']);

});

//class
Route::get('class', [ClassController::class, 'index']);
Route::get('class/{classes}', [ClassController::class, 'select_id']);