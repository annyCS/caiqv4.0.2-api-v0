<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\OrganizationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*--------------------------------------------------------------------------
 Login API
--------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------
 Organization API
--------------------------------------------------------------------------*/
Route::get('/organizations', [OrganizationController::class, 'organizations']);

Route::get('/organizations/{id}/detail', [
    OrganizationController::class, 'organizationDetail'
])->name('organization.detail');

Route::get('/organizations/{id}/listUsers', [
    OrganizationController::class, 'listUsers'
])->name('organization.listUsers');


/*--------------------------------------------------------------------------
 Domain API
--------------------------------------------------------------------------*/
Route::get('/domains', [DomainController::class, 'domains']);

Route::get('/domains/{id}/ccmcontrols', [
    DomainController::class, 'listccmcontrols'
])->name('domains.ccmcontrols');
