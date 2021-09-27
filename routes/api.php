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

Route::group(['namespace' => 'App\Http\Controllers\V1'], function () {
    Route::post('/login', 'AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('/users', 'UserController');
        Route::apiResource('/letter', 'LetterController');
        Route::apiResource('/companies', 'CompanyController');
        Route::apiResource('/employees', 'EmployeeController');
        Route::post('employees/import', 'EmployeeController@import');
        Route::patch('employees', 'EmployeeController@bulkDestroy');
        Route::put('employees', 'EmployeeController@bulkUpdate');
        Route::get('/races', 'EmployeeController@races');
        Route::get('/profile', 'AuthController@profile');
        Route::get('/statuses', 'EmployeeController@statuses');
        Route::get('/available-roles', 'UserController@getAvailableRoles');
        Route::get('/search', 'EmployeeController@search');

        Route::get('/logout', 'AuthController@logout');
    });
});

Route::fallback(function () {
    return response(['message' => 'Page does not exist'], JsonResponse::HTTP_NOT_FOUND);
});
