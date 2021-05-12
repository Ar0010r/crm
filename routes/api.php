<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('/login', 'AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('/users', 'UsersController');
        Route::apiResource('/companies', 'CompaniesController');
        Route::apiResource('/employees', 'EmployeesController');
        Route::post('employees/import', 'EmployeesController@import');
        Route::patch('employees', 'EmployeesController@bulkDestroy');
        Route::put('employees', 'EmployeesController@bulkUpdate');
        Route::get('/races', 'EmployeesController@races');
        Route::get('/profile', 'AuthController@profile');
        Route::get('/statuses', 'EmployeesController@statuses');
        Route::get('/available-roles', 'UsersController@getAvailableRoles');
        Route::get('/search', 'EmployeesController@search');

        Route::get('/logout', 'AuthController@logout');
    });
});

Route::fallback(function () {
    return response(['message' => 'Page does not exist'], JsonResponse::HTTP_NOT_FOUND);
});
