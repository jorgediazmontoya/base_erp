<?php

use App\Models\CustomTenant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantController;

Route::get('/tenants', [TenantController::class, 'index']);
Route::apiResource('tenants', TenantController::class)->except(['index'])->middleware('auth:api');

Route::delete('/tenants/{tenant}/flush-cache', function (CustomTenant $tenant) {
    $result = $tenant->execute(fn (CustomTenant $tenant) => cache()->flush());

    return response()->json(['success' => $result], Response::HTTP_OK);
});
