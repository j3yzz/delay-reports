<?php

use App\Containers\DeliveryAudit\Http\Controllers\DeliveryAuditController;
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


Route::group([
//    'middleware'    => ['auth', 'bannedUser', 'preventBackHistory'],
    'prefix'        => 'v1',
    'namespace'     => 'V1',
    'as'            => 'api.v1.',
], function() {
    Route::get('/delivery/audit/assign-report', [DeliveryAuditController::class, 'assignReport'])
        ->name('delivery.audit.assign-report');

    Route::get('delivery/audit/reports/{vendorId}', [DeliveryAuditController::class, 'reports'])
        ->name('delivery.audit.reports');

    Route::group(['middleware'    => ['auth:sanctum']], function() {
        Route::post('delivery/audit/{orderId}', [DeliveryAuditController::class, 'auditRequest'])
            ->name('delivery.audit');
    });
});

