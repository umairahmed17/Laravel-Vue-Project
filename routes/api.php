<?php

use App\Http\Controllers\TodayController;
use App\Http\Controllers\UpcomingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * Upcoming Task
 */

//Get all upcoming task
Route::get( "/upcoming", [UpcomingController::class, 'index'] );

//Get a single upcoming task.
Route::get( '/upcoming/{taskId}', [UpcomingController::class, 'show'] );

//Create a new task
Route::post( '/upcoming', [UpcomingController::class, 'store'] );

//Delete a upcoming task
Route::delete( '/upcoming/{taskId}', [UpcomingController::class, 'destroy'] );

Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request $request ) {
    return $request->user();
} );

/**
 * Today Task
 */
//Add a daily task.
Route::post( '/dailytask', [TodayController::class, 'store'] );

//Get all daily tasks.
Route::get( '/dailytask', [TodayController::class, 'index'] );
//Delete daily task
Route::delete( '/dailytask/{taskId}', [TodayController::class, 'destroy'] );