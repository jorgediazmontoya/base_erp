<?php

use App\Models\CustomTenant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantController;

Route::apiResource('tenants', TenantController::class)->middleware('auth:api');

Route::delete('/tenants/{tenant}/flush-cache', function (CustomTenant $tenant) {
    Cache::forget($tenant);
    return response()->json(['success' => $tenant], Response::HTTP_OK);
})->middleware('auth:api');
