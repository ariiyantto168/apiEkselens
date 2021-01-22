<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogActivitiesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrandingsController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CategoriesController;

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

            // Subclass
        Route::get('subclass', [ClassController::class, 'index_subclass']);
        Route::get('subclass/{subclass}', [ClassController::class, 'select_subclass']);
        // Materies
        Route::get('materies', [ClassController::class, 'index_materies']);
        Route::get('materies/{materies}', [ClassController::class, 'select_materies']);
        //Hilights
        Route::get('hilights', [ClassController::class, 'index_hilights']);
        Route::get('hilights/{hilights}', [ClassController::class, 'select_hilights']);

        // whislists
        Route::get('whislists', [WhislistsController::class, 'index']);
        Route::post('whislsts/create-new', [WhislistsController::class, 'create_save']);

});

//categories
Route::get('categories', [CategoriesController::class, 'index']);
Route::get('categories/{categories}', [CategoriesController::class, 'select_id']);

//class
Route::get('class', [ClassController::class, 'index']);
Route::get('class/{classes}', [ClassController::class, 'select_id']);

// Subclass
Route::get('subclass', [ClassController::class, 'index_subclass']);
Route::get('subclass/{subclass}', [ClassController::class, 'select_subclass']);
// Materies
Route::get('materies', [ClassController::class, 'index_materies']);
Route::get('materies/{materies}', [ClassController::class, 'select_materies']);
//Hilights
Route::get('hilights', [ClassController::class, 'index_hilights']);
Route::get('hilights/{hilights}', [ClassController::class, 'select_hilights']);

// Trandings
Route::get('populers', [TrandingsController::class, 'index_populers']);
Route::get('populers/{populers}', [TrandingsController::class, 'select_populers']);
Route::get('newclass', [TrandingsController::class, 'index_newclass']);
Route::get('newclass/{newclass}', [TrandingsController::class, 'select_newclass']);
Route::get('careers', [TrandingsController::class, 'index_careers']);
Route::get('careers/{careers}', [TrandingsController::class, 'select_careers']);
Route::get('testimonies', [TrandingsController::class, 'index_testimonies']);
Route::get('testimonies/{testimonies}', [TrandingsController::class, 'select_testimonies']);
Route::get('discounts', [TrandingsController::class, 'index_discounts']);
Route::get('discounts/{discounts}', [TrandingsController::class, 'select_discounts']);