<?php

use App\Models\CustomTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\UserController;
use App\Mail\EmailInvitation;

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

/*
*
*==============================Tenants routes==================================
*/

/**
 *
 * Files
 */
Route::middleware('auth:api')->apiResource('files', FileController::class);

/**
 *
 * Current tenant
 */
Route::get('/as-tenant', function () {
    return [
        'name' => app('currentTenant')->name,
        'domain' => app('currentTenant')->domain
    ];
});

/**
 * User auth "whoami"
 */
Route::get('/whoami', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/**
 *
 * Logout
 */
Route::post('/logout', function (Request $request) {
    $request->user()->token()->revoke();
    return response()->json(['message' => 'Good by user.']);
})->middleware('auth:api');

/**
 * Users
 */
Route::get('/users', [UserController::class, 'index'])->middleware('auth:api');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('auth:api');
Route::post('/users', [UserController::class, 'store'])->middleware('auth:api');

Route::post('/send-mail', function (Request $request) {
    Mail::to($request->email)->send(new EmailInvitation());
    return response()->json([
        'info' => "Invitación enviada a {$request->email}"
    ]);
})->middleware('auth:api');
