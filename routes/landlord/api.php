<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantController;

// Need security routes
Route::apiResource('tenants', TenantController::class)->middleware('auth:api');
