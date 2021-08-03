<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


/*
*
*Tenants routes
*/
Route::middleware('auth:api')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:api')->get('/users/{user}', [UserController::class, 'show']);
Route::middleware('auth:api')->post('/users', [UserController::class, 'store']);

Route::get('/as-tenant ', function () {
    return app('currentTenant');
});

/* Route::get('/token', function() {
    $user = Auth::user();
    $token = $user->createToken('Token Name')->accessToken;
    return $token;
});
 */
