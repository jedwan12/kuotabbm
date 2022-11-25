<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PassportAuthController;

use App\Http\Controllers\Api\BusinessUnitController;

use App\Http\Controllers\Api\DetailDistributionController;

use App\Http\Controllers\Api\DetailVehicleController;

use App\Http\Controllers\Api\DetailUserController;

use App\Http\Controllers\Api\DistributionController;

use App\Http\Controllers\Api\GasStationController;

use App\Http\Controllers\Api\LogController;

use App\Http\Controllers\Api\ManagementTypeController;

use App\Http\Controllers\Api\ManagementQuotaController;

use App\Http\Controllers\Api\PetrolController;

use App\Http\Controllers\Api\PositionController;

use App\Http\Controllers\Api\QRController;

use App\Http\Controllers\Api\RequestQuotaController;

use App\Http\Controllers\Api\RoleController;

use App\Http\Controllers\Api\TransactionController;

use App\Http\Controllers\Api\TransactionTypeController;

use App\Http\Controllers\Api\UserController;

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
Route::get('logs/request', [LogController::class, 'index_request']);
Route::get('logs/management', [LogController::class, 'index_management']);
Route::get('logs/transaction', [LogController::class, 'index_transaction']);
Route::post('logs', [LogController::class, 'store']);
Route::put('logs/{id}', [LogController::class, 'edit']);

Route::get('detail_vehicles', [DetailVehicleController::class, 'index']);
Route::post('detail_vehicles', [DetailVehicleController::class, 'store']);
Route::put('detail_vehicles/{id}', [DetailVehicleController::class, 'edit']);
Route::get('detail_vehicles/{id}', [DetailVehicleController::class, 'get_data_by_id']);
Route::get('list_detail_vehicles/{id}', [DetailVehicleController::class, 'vehicle_by_id']);
Route::get('form_request/{id}', [DetailVehicleController::class, 'vehicle_by_id']);
Route::get('detail_vehicles/delete/{id}', [DetailVehicleController::class, 'delete']);

// Route::get('plat_vehicles/{id}', [DetailVehicleController::class, 'plat_by_id']);
// Route::get('edit_quota_vehicles/{id}', [DetailVehicleController::class, 'vehicle_by_id']);


Route::get('detail_users', [DetailUserController::class, 'index']);
Route::post('detail_users', [DetailUserController::class, 'store']);
Route::put('detail_users/{id}', [DetailUserController::class, 'edit']);
Route::get('detail_users/{id}', [DetailUserController::class, 'get_data_by_id']);
Route::get('detail_users/delete/{id}', [DetailUserController::class, 'delete']);

Route::get('request_quota', [RequestQuotaController::class, 'index']);
Route::post('request_quota', [RequestQuotaController::class, 'store']);
Route::put('request_quota/{id}', [RequestQuotaController::class, 'edit']);
Route::get('request_quota_pegawai/{id}', [RequestQuotaController::class, 'request_quota_by_user_id']);
Route::get('request_quota_pegawai/detail/{id}', [RequestQuotaController::class, 'request_quota_by_id']);
Route::get('request_quota/approval/{status}/{id}', [RequestQuotaController::class, 'approval']);
Route::post('request_quota/reject/{id}', [RequestQuotaController::class, 'reject']);
// Route::get('request_quota/approval2/{status}/{id}', [RequestQuotaController::class, 'approval2']);


Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'edit']);
Route::get('users/{id}', [UserController::class, 'get_data_by_id']);

Route::get('roles', [RoleController::class, 'index']);
Route::post('roles', [RoleController::class, 'store']);
Route::put('roles/{id}', [RoleController::class, 'edit']);

Route::get('business_units', [BusinessUnitController::class, 'index']);
Route::post('business_units', [BusinessUnitController::class, 'store']);
Route::put('business_units/{id}', [BusinessUnitController::class, 'edit']);
Route::get('business_units/{id}', [BusinessUnitController::class, 'get_data_by_id']);
Route::get('business_units/delete/{id}', [BusinessUnitController::class, 'delete']);

Route::get('gas_stations', [GasStationController::class, 'index']);
Route::post('gas_stations', [GasStationController::class, 'store']);
Route::put('gas_stations/{id}', [GasStationController::class, 'edit']);
Route::get('gas_stations/{id}', [GasStationController::class, 'get_data_by_id']);
Route::get('gas_stations/delete/{id}', [GasStationController::class, 'delete']);

Route::get('petrols', [PetrolController::class, 'index']);
Route::post('petrols', [PetrolController::class, 'store']);
Route::put('petrols/{id}', [PetrolController::class, 'edit']);
Route::get('petrols/{id}', [PetrolController::class, 'get_data_by_id']);
Route::get('petrols/delete/{id}', [PetrolController::class, 'delete']);

Route::get('positions', [PositionController::class, 'index']);
Route::post('positions', [PositionController::class, 'store']);
Route::put('positions/{id}', [PositionController::class, 'edit']);

Route::get('transaction_types', [TransactionTypeController::class, 'index']);
Route::post('transaction_types', [TransactionTypeController::class, 'store']);
Route::put('transaction_types/{id}', [TransactionTypeController::class, 'edit']);

Route::get('vehicle_types', [VehicleTypeController::class, 'index']);
Route::post('vehicle_types', [VehicleTypeController::class, 'store']);
Route::put('vehicle_types/{id}', [VehicleTypeController::class, 'edit']);

Route::get('management_types', [ManagementTypeController::class, 'index']);
Route::post('management_types', [ManagementTypeController::class, 'store']);
Route::put('management_types/{id}', [ManagementTypeController::class, 'edit']);

// Route::get('detail_distributions', [DetailDistributionController::class, 'index']);
Route::get('detail_distributions/show/{id}/{userid}', [DetailDistributionController::class, 'index']);
Route::post('detail_distributions', [DetailDistributionController::class, 'store']);
Route::put('detail_distributions/{id}', [DetailDistributionController::class, 'edit']);
Route::get('detail_distributions/{id}', [DetailDistributionController::class, 'get_data_by_id']);
Route::get('detail_distributions/delete/{id}', [DetailDistributionController::class, 'delete']);

Route::get('distributions', [DistributionController::class, 'index']);
Route::post('distributions', [DistributionController::class, 'store']);
Route::put('distributions/{id}', [DistributionController::class, 'edit']);
Route::get('distributions/{id}', [DistributionController::class, 'get_data_by_id']);
Route::get('distributions/delete/{id}', [DistributionController::class, 'delete']);

Route::get('management_quotas', [ManagementQuotaController::class, 'index']);
Route::post('management_quotas', [ManagementQuotaController::class, 'store']);
// Route::put('management_quotas/{id}', [ManagementQuotaController::class, 'edit']);
Route::put('management_quotas/add_quota/{id}', [ManagementQuotaController::class, 'add_quota']);
Route::put('management_quotas/reduce_quota/{id}', [ManagementQuotaController::class, 'reduce_quota']);

Route::get('qr', [QRController::class, 'index']);
Route::post('qr', [QRController::class, 'generate_qr']);
Route::get('qr/{id}', [QRController::class, 'get_qr_by_id']);
Route::get('qr/delete/{id}', [QRController::class, 'delete']);

Route::get('transactions', [TransactionController::class, 'index']);
Route::post('transactions', [TransactionController::class, 'store']);
Route::get('transactions/{id}', [TransactionController::class, 'get_data_by_id']);
Route::get('transactions/confirmed/accept/{id}', [TransactionController::class, 'confirmed']);
Route::get('transactions/rejected/rejected/{id}', [TransactionController::class, 'rejected']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
