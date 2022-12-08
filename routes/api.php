<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\CategoryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api', 'checkpassword', 'changelanguage']], function () {
    Route::get('allCategory', [CategoryController::class, 'allCategory']);
    Route::post('get-Category-ById', [CategoryController::class, 'CategoryById']);
    Route::post('change-category-status', [CategoryController::class, 'changeCategoryStatus']);

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth.guard:admin-api');

    });
});
Route::group(['middleware' => ['api', 'checkpassword', 'changelanguage', 'auth.guard:admin-api']], function () {

    Route::post('change-category-status', [CategoryController::class, 'changeCategoryStatus']);

});
