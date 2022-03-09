<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

Route::group(['namespace' => 'App\Http\Controllers\V1'], function () {
    Route::post('/login', 'AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('/users', 'UserController');

        Route::get('companies/statistics', 'CompanyController@statistics');
        Route::apiResource('/companies', 'CompanyController');

        Route::get('letter/statistics', 'LetterController@statistics');
        Route::get('letter/total', 'LetterController@total');
        Route::apiResource('/letter', 'LetterController');

        Route::apiResource('/employees', 'EmployeeController');
        Route::post('employees/{employee}', 'EmployeeController@upload');
        Route::post('employees/import', 'EmployeeController@import');
        Route::patch('employees', 'EmployeeController@bulkDestroy');
        Route::put('employees', 'EmployeeController@bulkUpdate');
        Route::get('employee/media', 'EmployeeController@getMedia');
        Route::delete('employee/media/{media}', 'EmployeeController@deleteMedia');

        Route::get('/races', 'EmployeeController@races');
        Route::get('/profile', 'AuthController@profile');
        Route::get('/statuses', 'EmployeeController@statuses');
        Route::get('/available-roles', 'UserController@getAvailableRoles');

        Route::apiResource('/test', 'TestController');

        Route::get('/logout', 'AuthController@logout');
    });
});

Route::fallback(function () {
    return response(['message' => 'Page does not exist'], JsonResponse::HTTP_NOT_FOUND);
});
