<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PassportAuthController;

use App\Http\Controllers\Api\LogController;

use App\Http\Controllers\Api\DetailVehicleController;

use App\Http\Controllers\Api\DetailUserController;

use App\Http\Controllers\Api\RequestQuotaController;

use App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Api\RoleController;

use App\Http\Controllers\Api\BusinessUnitController;

use App\Http\Controllers\Api\GasStationController;

use App\Http\Controllers\Api\PetrolController;

use App\Http\Controllers\Api\PositionController;

use App\Http\Controllers\Api\TransactionTypeController;

use App\Http\Controllers\Api\VehicleTypeController;
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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::get('logs', [LogController::class, 'index']);
Route::post('logs', [LogController::class, 'store']);
Route::put('logs/{id}', [LogController::class, 'edit']);

Route::get('detail_vehicles', [DetailVehicleController::class, 'index']);
Route::post('detail_vehicles', [DetailVehicleController::class, 'store']);
Route::put('detail_vehicles/{id}', [DetailVehicleController::class, 'edit']);

Route::get('detail_users', [DetailUserController::class, 'index']);
Route::post('detail_users', [DetailUserController::class, 'store']);
Route::put('detail_users/{id}', [DetailUserController::class, 'edit']);

Route::get('request_quota', [RequestQuotaController::class, 'index']);
Route::post('request_quota', [RequestQuotaController::class, 'store']);
Route::put('request_quota/{id}', [RequestQuotaController::class, 'edit']);

Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'edit']);

Route::get('roles', [RoleController::class, 'index']);
Route::post('roles', [RoleController::class, 'store']);
Route::put('roles/{id}', [RoleController::class, 'edit']);

Route::get('business_units', [BusinessUnitController::class, 'index']);
Route::post('business_units', [BusinessUnitController::class, 'store']);
Route::put('business_units/{id}', [BusinessUnitController::class, 'edit']);

Route::get('gas_stations', [GasStationController::class, 'index']);
Route::post('gas_stations', [GasStationController::class, 'store']);
Route::put('gas_stations/{id}', [GasStationController::class, 'edit']);

Route::get('petrols', [PetrolController::class, 'index']);
Route::post('petrols', [PetrolController::class, 'store']);
Route::put('petrols/{id}', [PetrolController::class, 'edit']);

Route::get('positions', [PositionController::class, 'index']);
Route::post('positions', [PositionController::class, 'store']);
Route::put('positions/{id}', [PositionController::class, 'edit']);

Route::get('transaction_types', [TransactionTypeController::class, 'index']);
Route::post('transaction_types', [TransactionTypeController::class, 'store']);
Route::put('transaction_types/{id}', [TransactionTypeController::class, 'edit']);

Route::get('vehicle_types', [VehicleTypeController::class, 'index']);
Route::post('vehicle_types', [VehicleTypeController::class, 'store']);
Route::put('vehicle_types/{id}', [VehicleTypeController::class, 'edit']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
