<?php

use App\Models\Client;
use App\Models\CustomTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TenantController;

// Need security routes
Route::apiResource('tenants', TenantController::class)->middleware('auth:api');

Route::get('/tenants/{tenant}/clients', function (CustomTenant $tenant) {
    //$result = $tenant->execute(fn (CustomTenant $tenant) => cache()->flush());
    /*$result = $tenant->execute(function (CustomTenant $tenant) {

    });*/

    $client = Client::where('password_client', '=', true)->first();
    
    dd($client);
})->middleware('auth:api');
