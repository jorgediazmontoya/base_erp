<?php

use App\Http\Controllers\Api\TenantController;

// Need security routes
Route::apiResource('tenants', TenantController::class);
