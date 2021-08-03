<?php

use App\Models\Client;
use App\Models\CustomTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\PersonalAccessClient;
use App\Http\Controllers\Api\TenantController;

// Need security routes
Route::apiResource('tenants', TenantController::class)->middleware('auth:api');





// Prueba tentativa no oficial
Route::post('/tenants/{tenant}/clients', function (Request $request, CustomTenant $tenant) {
    /*$result = $tenant->execute(function (CustomTenant $tenant) {

    });*/

    //$client = Client::where('password_client', '=', true)->first();

    $client = Client::create([
        'name' => $tenant->name,
        'secret' => config('passport.personal_access_client.secret'),
        'redirect' => 'http://localhost',
        'personal_access_client' => '1',
        'password_client' => '0',
        'revoked' => '0',
    ]);

    PersonalAccessClient::create([
        'client_id' => $client->id,
    ]);

    return response()->json($client->getPlainSecretAttribute());
});
